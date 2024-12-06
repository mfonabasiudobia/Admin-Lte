INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
('1', 'add_user', 'api', '2023-03-31 00:32:53', '2023-03-31 00:32:53'),
('10', 'view_service', 'api', '2023-04-13 23:22:19', '2023-04-13 23:22:19'),
('11', 'edit_service', 'api', '2023-04-13 23:22:23', '2023-04-13 23:22:23'),
('12', 'delete_service', 'api', '2023-04-13 23:22:28', '2023-04-13 23:22:28'),
('13', 'manage_settings', 'api', '2023-04-13 23:22:48', '2023-04-13 23:22:48'),
('14', 'manage_employee', 'api', '2023-04-13 23:22:57', '2023-04-13 23:22:57'),
('15', 'add_order_type', 'api', '2023-04-13 23:23:14', '2023-04-13 23:23:14'),
('16', 'view_order_type', 'api', '2023-04-13 23:23:18', '2023-04-13 23:23:18'),
('17', 'edit_order_type', 'api', '2023-04-13 23:23:22', '2023-04-13 23:23:22'),
('18', 'delete_order_type', 'api', '2023-04-13 23:23:28', '2023-04-13 23:23:28'),
('19', 'edit_order_status', 'api', '2023-04-13 23:23:40', '2023-04-13 23:23:40'),
('2', 'edit_user', 'api', '2023-03-31 00:33:04', '2023-03-31 00:33:04'),
('20', 'view_orders', 'api', '2023-04-13 23:23:59', '2023-04-13 23:23:59'),
('3', 'view_user', 'api', '2023-03-31 00:33:12', '2023-03-31 00:33:12'),
('4', 'delete_user', 'api', '2023-03-31 00:33:22', '2023-03-31 00:33:22'),
('5', 'add_coupon', 'api', '2023-04-13 23:21:31', '2023-04-13 23:21:31'),
('6', 'view_coupon', 'api', '2023-04-13 23:21:42', '2023-04-13 23:21:42'),
('7', 'edit_coupon', 'api', '2023-04-13 23:21:46', '2023-04-13 23:21:46'),
('8', 'delete_coupon', 'api', '2023-04-13 23:21:51', '2023-04-13 23:21:51'),
('9', 'add_service', 'api', '2023-04-13 23:22:14', '2023-04-13 23:22:14');

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
('1', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('10', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('11', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('12', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('13', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('14', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('15', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('16', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('17', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('18', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('19', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('2', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('20', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('3', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('4', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('5', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('6', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('7', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('8', '9a180afc-6901-40ee-97ea-2b26559e61f6'),
('9', '9a180afc-6901-40ee-97ea-2b26559e61f6');

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_uuid`) VALUES
('9a180afc-6901-40ee-97ea-2b26559e61f6', 'App\\Models\\User', '9a180afc-b908-4b4a-a5df-bb23ad405d0a'),
('9a180afc-7ce1-43f7-9a1c-1f9fa71e3794', 'App\\Models\\User', '9a180be8-2f84-4a84-ad02-c2e56c446cea'),
('9a180afc-7ce1-43f7-9a1c-1f9fa71e3794', 'App\\Models\\User', '9a181c41-0930-4976-b3d8-a0cd7494ed66'),
('9a180afc-7ce1-43f7-9a1c-1f9fa71e3794', 'App\\Models\\User', '9a212e1f-f487-4959-aece-c36aa16c2cc5'),
('9a180afc-7ce1-43f7-9a1c-1f9fa71e3794', 'App\\Models\\User', '9a22e8a1-916e-404a-8d14-cb5ae42fa8ae'),
('9a180afc-7ce1-43f7-9a1c-1f9fa71e3794', 'App\\Models\\User', '9a22e967-3d8d-435b-8dc2-f34dba51ad3c'),
('9a180afc-7ce1-43f7-9a1c-1f9fa71e3794', 'App\\Models\\User', '9a22ec23-68d3-4cba-9ac0-d4de6fe5b2bf'),
('9a180afc-7ce1-43f7-9a1c-1f9fa71e3794', 'App\\Models\\User', '9a22ed20-3574-4f6e-935f-b47bb2ff5769'),
('9a180afc-7ce1-43f7-9a1c-1f9fa71e3794', 'App\\Models\\User', '9a22ede7-0f95-40d0-945f-14820fb6b803');
