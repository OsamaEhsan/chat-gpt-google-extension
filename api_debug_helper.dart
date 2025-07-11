import 'dart:convert';
import 'dart:developer';
import 'package:http/http.dart' as http;
import 'package:intl/intl.dart';

class ApiDebugHelper {
  static const String baseUrl = 'https://myathlos.com/api'; // Update with your actual base URL
  
  static Future<void> testDashboardEndpoint(String token) async {
    final String currentDate = DateFormat('yyyy-MM-dd').format(DateTime.now());
    final Uri url = Uri.parse('$baseUrl/dashboard?date=$currentDate');
    
    print('=== Testing Dashboard API ===');
    print('URL: $url');
    print('Date: $currentDate');
    print('Token: ${token.length > 10 ? '${token.substring(0, 10)}...' : token}');
    print('');
    
    // Test with GET method
    await _testWithMethod('GET', url, token);
    
    // Test with POST method
    await _testWithMethod('POST', url, token);
  }
  
  static Future<void> _testWithMethod(String method, Uri url, String token) async {
    print('--- Testing with $method ---');
    
    try {
      http.Response response;
      
      final headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': 'Bearer $token',
      };
      
      if (method == 'GET') {
        response = await http.get(url, headers: headers);
      } else {
        response = await http.post(url, headers: headers);
      }
      
      print('Status Code: ${response.statusCode}');
      print('Status Message: ${response.reasonPhrase}');
      print('Headers: ${response.headers}');
      print('Body Length: ${response.body.length}');
      print('Body: ${response.body}');
      
      if (response.statusCode == 200) {
        try {
          final json = jsonDecode(response.body);
          print('✅ JSON parsed successfully');
          
          if (json is Map<String, dynamic>) {
            print('✅ Response is a Map');
            
            // Check required fields
            final requiredFields = ['status', 'message', 'user', 'selected_day', 'progress', 'today_workout'];
            for (final field in requiredFields) {
              if (json.containsKey(field)) {
                print('✅ Field "$field" exists: ${json[field].runtimeType}');
              } else {
                print('❌ Field "$field" missing');
              }
            }
            
            // Check today_workout specifically
            if (json.containsKey('today_workout')) {
              final todayWorkout = json['today_workout'];
              if (todayWorkout is List) {
                print('✅ today_workout is a List with ${todayWorkout.length} items');
                for (int i = 0; i < todayWorkout.length && i < 5; i++) {
                  print('   [$i]: ${todayWorkout[i]} (${todayWorkout[i].runtimeType})');
                }
              } else {
                print('❌ today_workout is not a List: ${todayWorkout.runtimeType}');
              }
            }
          } else {
            print('❌ Response is not a Map: ${json.runtimeType}');
          }
        } catch (e) {
          print('❌ JSON parse error: $e');
        }
      } else {
        print('❌ Request failed');
      }
      
    } catch (e, stackTrace) {
      print('❌ Exception: $e');
      print('Stack trace: $stackTrace');
    }
    
    print('');
  }
}

// Usage example:
// void main() async {
//   final token = 'your_token_here';
//   await ApiDebugHelper.testDashboardEndpoint(token);
// }