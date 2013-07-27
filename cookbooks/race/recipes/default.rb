
apt_package "php5-curl" do
  :install
end

directory "#{node['race']['dir']}" do
  owner "vagrant"
  group "vagrant"
  mode "0755"
  action :create
  recursive true
end

directory "#{node['apache']['log_dir']}" do
  owner "vagrant"
  group "vagrant"
  mode "0755"
  action :create
  recursive true
end

execute "create #{node['race']['db']} database" do
  command "/usr/bin/mysqladmin -u root -p\"#{node['mysql']['server_root_password']}\" create #{node['race']['db']}"    
  action :run
  creates "/var/lib/mysql/#{node['race']['db']}"
end

# make sure that apache is loading the ini with the chef directives
file "/etc/php5/apache2/php.ini" do
  action :delete
end

# link /etc/php5/cli/php.ini
link "/etc/php5/apache2/php.ini" do
  to "/etc/php5/cli/php.ini"
end

apache_site "000-default" do
  enable false
end

web_app "race" do
  template "race.conf.erb"
  docroot "#{node['race']['dir']}"
  server_name node['race']['server_name']
end

service "apache2" do 
  action :restart
end

