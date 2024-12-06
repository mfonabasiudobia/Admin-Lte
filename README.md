<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Cubet Techno Labs](https://cubettech.com)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[Many](https://www.many.co.uk)**
-   **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
-   **[DevSquad](https://devsquad.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[OP.GG](https://op.gg)**
-   **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
-   **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# RocketPay-Backend

API KEY: d352d4a957f70982aeb89e8bd6bc55eb

# Connect-App

ALTER TABLE `cards` ADD `cover_photo` VARCHAR(255) NOT NULL DEFAULT 'images/default-cover-photo.png' AFTER `profile_image`;

ALTER TABLE `cards` ADD `day` VARCHAR(255) NULL DEFAULT NULL AFTER `links`, ADD `month` VARCHAR(255) NULL DEFAULT NULL

AFTER `day`, ADD `year` VARCHAR(255) NULL DEFAULT NULL AFTER `month`;
ALTER TABLE `cards` ADD `athlete_teams` LONGTEXT NULL DEFAULT NULL AFTER `education`;
ALTER TABLE `cards` ADD `athlete_tournaments` LONGTEXT NULL DEFAULT NULL AFTER `education`;
ALTER TABLE `cards` ADD `athlete_academic_awards` LONGTEXT NULL DEFAULT NULL AFTER `education`;
ALTER TABLE `cards` ADD `athlete_awards` LONGTEXT NULL DEFAULT NULL AFTER `education`;
ALTER TABLE `cards` ADD `athlete_school` LONGTEXT NULL DEFAULT NULL AFTER `education`;
ALTER TABLE `cards` ADD `business` LONGTEXT NULL DEFAULT NULL AFTER `education`;

ALTER TABLE `users` ADD `notification_deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `online_status`, ADD `notification_seen_at` TIMESTAMP NULL DEFAULT NULL AFTER `notification_deleted_at`;

ALTER TABLE `cards` CHANGE `status` `status` ENUM('active','inactive','draft') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active';

ALTER TABLE `cards` ADD `notes` LONGTEXT NULL DEFAULT NULL AFTER `preferred_contact_method`;

ALTER TABLE `cards` ADD `situation_status` VARCHAR(255) NULL DEFAULT NULL AFTER `notes`;

ALTER TABLE `cards` CHANGE `status` `status` ENUM('active','inactive','draft','unused') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active';

ALTER TABLE `transactions` ADD `price` DECIMAL(24,2) NOT NULL DEFAULT '0' AFTER `amount`, ADD `quantity` INT NOT NULL DEFAULT '1' AFTER `price`;

ALTER TABLE `cards` ADD `expires_at` DATETIME NULL DEFAULT NULL AFTER `situation_status`;

ALTER TABLE `cards` ADD `height` VARCHAR(255) NULL DEFAULT NULL AFTER `teams`;
ALTER TABLE `cards` ADD `sport_type` VARCHAR(255) NULL DEFAULT NULL AFTER `teams`;
ALTER TABLE `cards` ADD `athlete_years_of_experience` VARCHAR(255) NULL DEFAULT NULL AFTER `teams`;
ALTER TABLE `cards` ADD `athlete_current_position` VARCHAR(255) NULL DEFAULT NULL AFTER `teams`;
ALTER TABLE `cards` CHANGE `preferred_contact_method` `preferred_contact_method` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `cards` ADD `can_notify` BOOLEAN NOT NULL DEFAULT TRUE AFTER `situation_status`;
ALTER TABLE `connections` ADD `can_notify` BOOLEAN NOT NULL DEFAULT TRUE AFTER `notes`;
ALTER TABLE `cards` ADD `unique_code` VARCHAR(255) NULL DEFAULT NULL AFTER `user_id`, ADD UNIQUE (`unique_code`(7));

ALTER TABLE `users` ADD `account_status` ENUM("blocked", "active") NOT NULL DEFAULT 'active' AFTER `online_status`;

ALTER TABLE `transactions` ADD `query2` JSON NULL DEFAULT NULL AFTER `query1`;

ALTER TABLE `notifications` ADD `image` VARCHAR(255) NULL DEFAULT NULL AFTER `content`;

ALTER TABLE `users` ADD `birthday_notification` TINYINT(1) NOT NULL DEFAULT '1' AFTER `delete_reason`, ADD `status_notification` TINYINT(1) NOT NULL DEFAULT '1' AFTER `birthday_notification`, ADD `card_notification` TINYINT(1) NOT NULL DEFAULT '1' AFTER `status_notification`;

sudo supervisorctl restart all
# Admin-Lte
