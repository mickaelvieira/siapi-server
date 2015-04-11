

class { 'apache':
  mpm_module => false
}

apache::vhost { 'siapi.dev':
  port          => '80',
  docroot       => '/vagrant/web',
  docroot_owner => 'vagrant',
  docroot_group => 'vagrant',
  serveraliases => ['www.siapi.dev'],
  options       => ['Indexes','FollowSymLinks','MultiViews'],
  override      => 'All'
}

class { 'apache::mod::prefork': }
class { 'apache::mod::php': }
class { 'apache::mod::rewrite': }
class { 'apache::mod::headers': }

class { 'php':
  service             => 'apache',
  service_autorestart => false,
  module_prefix       => '',
}

php::module { 'php5-mysql': }
php::module { 'php5-cli': }
php::module { 'php5-curl': }
php::module { 'php5-intl': }
php::module { 'php5-mcrypt': }
php::module { 'php5-gd': }
php::module { 'php-apc': }

class { 'php::devel':
  require => Class['php'],
}

class { 'php::pear':
  require => Class['php'],
}

class { 'rabbitmq':
  port => '5672'
}

