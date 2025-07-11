import 'dart:convert';
import 'dart:developer';
import 'package:athlos/.env.dart';
import 'package:athlos/constants/user_functions.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'package:intl/intl.dart';
import '../models/dashboard_data.dart';

class DashboardController extends GetxController { 

  var isLoading = false.obs;
  var dashboardData = Rxn<DashboardData>();
  var errorMessage = ''.obs;

  Future<void> fetchDashboardData() async {
    final String? token = UserStorage.getToken();

    if (token == null) {
      errorMessage.value = 'Token not found';
      log('ERROR: Token not found');
      return;
    }

    final String currentDate = DateFormat('yyyy-MM-dd').format(DateTime.now());
    final Uri url = Uri.parse('$base_url/dashboard?date=$currentDate');
    log('Making request to: ${url.toString()}');
    
    try {
      isLoading.value = true;
      errorMessage.value = ''; // Clear previous errors

      // Try GET first (most common for dashboard endpoints)
      var response = await http.get(
        url,
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'Authorization': 'Bearer $token',
        },
      );

      // If GET fails with 405, try POST
      if (response.statusCode == 405) {
        log('GET failed with 405, trying POST...');
        response = await http.post(
          url,
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer $token',
          },
        );
      }

      log('Response status: ${response.statusCode}');
      log('Response body: ${response.body}');

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        log('Parsed JSON: $data');
        
        // Validate the data structure
        if (data != null && data is Map<String, dynamic>) {
          dashboardData.value = DashboardData.fromJson(data);
          log('Dashboard data loaded successfully');
          log('Today workout count: ${dashboardData.value?.todayWorkout.length ?? 0}');
          
          // Log the actual workout data for debugging
          dashboardData.value?.todayWorkout.forEach((workout) {
            log('Workout: $workout');
          });
        } else {
          errorMessage.value = 'Invalid data format received';
          log('ERROR: Invalid data format - $data');
        }
      } else {
        errorMessage.value = 'Failed: ${response.statusCode} - ${response.reasonPhrase}';
        log('ERROR: HTTP ${response.statusCode} - ${response.body}');
      }
    } catch (e, stackTrace) {
      errorMessage.value = 'Error: $e';
      log('ERROR: Exception occurred - $e');
      log('Stack trace: $stackTrace');
    } finally {
      isLoading.value = false;
    }
  }

  // Helper method to retry the request
  void retryFetch() {
    fetchDashboardData();
  }

  // Method to manually clear error and refresh
  void clearErrorAndRefresh() {
    errorMessage.value = '';
    fetchDashboardData();
  }
}