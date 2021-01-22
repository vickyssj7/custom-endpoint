# WP Custom Endpoint Plugin for listing JSON Placeholder data
Custom Endpoint plugin will set up a new endpoint with endpoint `json-placeholder-users` (which is a default endpoint)

Admin can edit this default endpoint by going under `Settings > Custom Endpoint option`, and on changing the endpoint will set the new endpoint added by admin user.

# Recommended

 * Wordpress >= 4.7
 * PHP Version >= 7.2

# Filter Hooks
* ### custom_endpoint_users_json_list
   This filter will allows to modify the users list response data.
   
* ### custom_endpoint_single_user_detail
   This filter will allows to modify the single user response data.
   
* ### custom_endpoint_table_headers
   This filter will allows to modify the table headers.
