node "web" {
  class {'nginx': }

  file { "/etc/nginx/sites-available/vhost.vagrant.conf":
    path => "/etc/nginx/sites-available/vhost.vagrant.conf",
    ensure => file,
    require => Package['nginx'],
    owner => 'root',
    group   => 'root',
    content => template('/var/vagrant/devops/puppet/manifests/templates/vhost.vagrant.conf.erb'),
    notify => Service['nginx']
  }

  file { "/etc/nginx/sites-enabled/vhost.vagrant.conf":
    path => "/etc/nginx/sites-enabled/vhost.vagrant.conf",
    target => "/etc/nginx/sites-available/vhost.vagrant.conf",
    ensure => link,
    notify => Service['nginx'],
    require => [
      Package['nginx'],
      File['/etc/nginx/sites-available/vhost.vagrant.conf'],
    ]
  }

  $packages = [ "php", "php-fpm", "php-mysql", "php-xdebug", "php-curl", "curl", "git", "wget" ]
  package { $packages : ensure => installed }

  package {"apache2": ensure => purged }

  class { '::mysql::server':
    root_password           => 'root',
    remove_default_accounts => true,
    override_options => { 'mysqld' => { 'max_connections' => '1024', 'bind_address' => '0.0.0.0' }},
    users => {'root@%' => {ensure => 'present'}},
    grants => {'root@%/*.*' => {
      ensure     => 'present',
      options    => ['GRANT'],
      privileges => ['ALL'],
      table      => '*.*',
      user       => 'root@%'
    }
    },
  }

}
