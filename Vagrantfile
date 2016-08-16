Vagrant.configure("2") do |config|

  config.vm.define "web" do |web|
      web.vm.box = "ubuntu/xenial64"

      web.vm.hostname = "web"
      web.vm.network :forwarded_port, guest: 80, host: 8080
      web.vm.network :forwarded_port, guest: 443, host: 4443
      web.vm.network "private_network", ip: "192.168.0.101"

      config.vm.synced_folder "./", "/var/vagrant"


      web.vm.provider "virtualbox" do |vb|
        vb.name = "bionic-vm"
      end

      web.vm.provision :shell, :path => "devops/puppet/shell/debian.sh"
      web.vm.provision :shell, :path => "devops/puppet/shell/puppet.sh"

      web.vm.provision :puppet do |puppet|
        puppet.manifest_file  = "web.pp"
        puppet.manifests_path = "devops/puppet/manifests"
        puppet.module_path = "devops/puppet/modules"
      end

      web.vm.provision :shell, :path => "devops/puppet/shell/composer.sh"
      web.vm.provision :shell, :path => "devops/puppet/shell/mysql-restart.sh"

  end

end
