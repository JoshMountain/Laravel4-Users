laravel-authentication
======================

A basic user registration and authentication system built with Laravel 4

To-Do
======================

Setup migration

To Install
======================

- Edit /app/config/mail.php and set your SMTP info
- Edit /app/config/database.php and set DB info
- Edit /app/config/app.php and set site URL, timezone, and encryption key
- Customize your /views


Database
======================

```
CREATE TABLE `users` (
`id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `password_temp` varchar(60) NOT NULL,
  `code` varchar(60) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
```
