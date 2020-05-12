const mix = require('laravel-mix');

 mix.js('resources/js/app.js', 'public/js')
   	.webpackConfig({
   		resolve: {
   			alias: {
            '@': path.resolve(__dirname, 'resources/js/src'),
   					'@assets': path.resolve(__dirname, 'resources/assets'),
            '@components': path.resolve(__dirname, 'resources/js/src/components'),
   	        '@sass': path.resolve(__dirname, 'resources/sass')
   			}
   		},


   	})
    .sass('resources/sass/app.scss', 'public/css');

 mix.styles([
   'resources/assets/css/bootstrap.min.css',
   'resources/assets/css/now-ui-dashboard.css',
   'resources/assets/demo/demo.css'
 ],
 'public/css/app.css').version();

 mix.scripts([
   'resources/assets/js/core/jquery.min.js',
   'resources/assets/js/core/popper.min.js',
   'resources/assets/js/core/bootstrap.min.js',
   'resources/assets/js/plugins/perfect-scrollbar.jquery.min.js',
   'resources/assets/js/plugins/chartjs.min.js',
   'resources/assets/js/plugins/bootstrap-notify.js',
   // 'resources/assets/js/now-ui-dashboard.min.js',
   'resources/assets/demo/demo.js',
   // 'https://unpkg.com/vue/dist/vue.js',
   // 'https://unpkg.com/vue-toastr/dist/vue-toastr.umd.min.js'
 ],
 'public/js/bansos.js').version();
