
```
# Clone the project with composer
composer create-project tuandm/laravue
cd laravue

# Migration and DB seeder (after changing your DB settings in .env)
php artisan migrate --seed

# Generate JWT secret key
php artisan jwt:secret

# Install dependency - we recommend using Yarn instead of NPM since we get errors while using NPM
yarn install

-------------------------------
yarn install v1.19.1
[1/4] Resolving packages...
error Couldn't find the binary git
info Visit https://yarnpkg.com/en/docs/cli/install for documentation about this command.

>>> add git path to sys path in win10
--------------------------------
-------------------------------
 Proxy CONNECT aborted
git config --global http.proxy http://192.168.8.16:808
git config --global https.proxy http://192.168.8.16:808
yarn config set proxy http://192.168.8.16:808
yarn confit set https-proxy http://192.168.8.16:808

fatal: unable to access 'https://github.com/nhn/raphael.git/': Proxy CONNECT aborted

npm cache clean --force
git config --global http.sslverify "false"
npm cache clear

ssh-keygen -t rsa -C "nekohor@foxmail.com"

-------------------------------

fatal: unable to look up github.com (port 9418)

>>> git config --global url."https://".insteadOf git://

-------------------------------
error An unexpected error occurred: "https://registry.yarnpkg.com/element-ui/-/element-ui-2.12.0.tgz: unexpected end of file".

yarn config set registry https://registry.npm.taobao.org
------------------------------


# Build for development
yarn run dev # or yarn run watch

# Start local development server
php artisan serve
```

router中修改数组元素，i18n新增名称

------------------------
indent修正



Vue中提示tab缩进代码时缩进一直是2格而不是4格，检查了一下phpStorm的配置：
File > Settings > Editor > Code Style > JavaScript的设置，发现Indent的键值为4：

于是修改项目根目录下的.editorconfig配置文件中indent_sie为2

将该indent_size的值修改为4保存即可。

注：在修改后必须关闭项目或重启PhpStorm才能使设置生效！

------------------------
