# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  # All Vagrant configuration is done here. The most common configuration
  # options are documented and commented below. For a complete reference,
  # please see the online documentation at vagrantup.com.

  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "precise64"

  # The url from where the 'config.vm.box' box will be fetched if it
  # doesn't already exist on the user's system.
  config.vm.box_url = "http://files.vagrantup.com/precise64.box"

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  config.vm.network :forwarded_port, guest: 80, host: 8080
  config.vm.network :forwarded_port, guest: 3306, host: 33060

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  # config.vm.network :private_network, ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network :public_network

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  config.vm.synced_folder ".", "/data/www/race"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #

  config.vm.provider :virtualbox do |vb|
    vb.gui = false  
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

  config.vm.provision :chef_solo do |chef|
    chef.add_recipe "apt"
    chef.add_recipe "apache2"
    chef.add_recipe "mysql::server"
    chef.add_recipe "php"
    chef.add_recipe "php::module_mysql"
    chef.add_recipe "apache2::mod_php5"
    chef.add_recipe "git"
    chef.add_recipe "race"
  
    chef.json = { 
      "apache" => {
        "log_dir" => "/data/www/race/logs",
        "user" => "vagrant",
        "group" => "vagrant"
      },
      "php" => {
        "directives" => {
          "display_errors" => "On",
          "display_startup_errors" => "On",
          "error_reporting" => "E_ALL | E_STRICT",
          "log_errors" => "On",
          "error_log" => "/data/www/race/logs/php.error.log",
          "short_open_tag" => "1",
          "post_max_size" => "1024M",
          "upload_max_filesize" => "1024M"
        }
      },
      "fqdn" => "race.local",
      "mysql" => {
        "bind_address" => "localhost",        
        "server_debian_password" => "root",
        "server_repl_password" => "root",
        "server_root_password" => "root",
        "allow_remote_root" => true
      },
      "race" => {
        "dir" => "/data/www/race/public",
        "db" => "race"
      }
    }
  end

end
