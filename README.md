# WP Custom Endpoint Plugin
Custom Endpoint plugin allows admin to get access to a new endpoint named `json-placeholder-users` (default endpoint)

Admin can modify this default endpoint under Settings > Custom Endpoint option as per their need, and on saving the changes endpoint will be set to the new modified endpoint by admin user.

# Min Requirements

    Wordpress - Tested on 5.5.3
    PHP Version >= 7.2

# Hooks
   ### `custom_endpoint_users_json_list`
   This hook will allows to modify the users list response data.
   
   ### `custom_endpoint_single_user_detail`
   This hook will allows to modify the single user response data.
   
   ### `custom_endpoint_table_headers`
   This hook will allows to modify the table headers.

## More info coming soon...
