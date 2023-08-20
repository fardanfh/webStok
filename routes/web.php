<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
	return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('dashboard', function () {
	return view('layouts.master');
});


Route::get('/reseller/login', 'Auth\Login\LoginResellerController@showLoginForm')->name('reseller.login');
Route::post('/reseller/login', 'Auth\Login\LoginResellerController@login')->name('reseller.login.post');
Route::post('/reseller/logout', 'Auth\Login\LoginResellerController@logout')->name('reseller.logout');
//Admin Home page after login
Route::group(['middleware' => 'reseller'], function () {
	Route::get('/reseller/home', 'ResellerController@index');
	Route::get('/reseller/product', 'ResellerController@product');
	Route::get('/reseller/product/detail/{id}', 'ResellerController@detail');
	Route::get('/reseller/product/detail/produk/{id}', 'ResellerController@detailproduk');
	Route::get('/reseller/transaksi', 'ResellerController@transaksi');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('categories', 'CategoryController');
	Route::get('/apiCategories', 'CategoryController@apiCategories')->name('api.categories');
	Route::get('/exportCategoriesAll', 'CategoryController@exportCategoriesAll')->name('exportPDF.categoriesAll');
	Route::get('/exportCategoriesAllExcel', 'CategoryController@exportExcel')->name('exportExcel.categoriesAll');

	Route::resource('customers', 'CustomerController');
	Route::get('/apiCustomers', 'CustomerController@apiCustomers')->name('api.customers');
	Route::post('/importCustomers', 'CustomerController@ImportExcel')->name('import.customers');
	Route::get('/exportCustomersAll', 'CustomerController@exportCustomersAll')->name('exportPDF.customersAll');
	Route::get('/exportCustomersAllExcel', 'CustomerController@exportExcel')->name('exportExcel.customersAll');

	Route::get('/transaksiReseller/{id}', 'CustomerController@transaksi');
	Route::get('/transaksiReseller/search/{id}', 'CustomerController@search');
	Route::get('/exportTransaksiPdf/{id}', 'CustomerController@exportTransaksiPdf');
	Route::get('/exportTransaksiExcel/{id}', 'CustomerController@exportDataExcel');

	Route::resource('sales', 'SaleController');
	Route::get('/apiSales', 'SaleController@apiSales')->name('api.sales');
	Route::post('/importSales', 'SaleController@ImportExcel')->name('import.sales');
	Route::get('/exportSalesAll', 'SaleController@exportSalesAll')->name('exportPDF.salesAll');
	Route::get('/exportSalesAllExcel', 'SaleController@exportExcel')->name('exportExcel.salesAll');

	Route::resource('suppliers', 'SupplierController');
	Route::get('/apiSuppliers', 'SupplierController@apiSuppliers')->name('api.suppliers');
	Route::post('/importSuppliers', 'SupplierController@ImportExcel')->name('import.suppliers');
	Route::get('/exportSupplierssAll', 'SupplierController@exportSuppliersAll')->name('exportPDF.suppliersAll');
	Route::get('/exportSuppliersAllExcel', 'SupplierController@exportExcel')->name('exportExcel.suppliersAll');

	Route::resource('products', 'ProductController');
	Route::get('/apiProducts', 'ProductController@apiProducts')->name('api.products');
	Route::get('/product/harga', 'ProductController@harga');
	Route::get('/products/detail/{id}', 'ProductController@detail')->name('detail.products');

	Route::get('/products/ukuran/{id}', 'ProductController@detail')->name('detail.products');

	Route::resource('details', 'DetailProductController');
	Route::get('/detail/{id}', 'DetailProductController@detail');
	Route::post('/detailStore', 'DetailProductController@store');
	Route::get('/add_detail/{id}', 'DetailProductController@create');
	Route::get('/detailproduk/{id}', 'DetailProductController@detailproduk');

	Route::resource('productsOut', 'ProductKeluarController');
	Route::get('/apiProductsOut', 'ProductKeluarController@apiProductsOut')->name('api.productsOut');
	Route::get('/exportProductKeluarAll', 'ProductKeluarController@exportProductKeluarAll')->name('exportPDF.productKeluarAll');
	Route::get('/exportProductKeluarAllExcel', 'ProductKeluarController@exportExcel')->name('exportExcel.productKeluarAll');
	Route::get('/exportProductKeluar/{id}', 'ProductKeluarController@exportProductKeluar')->name('exportPDF.productKeluar');

	Route::get('/laporans', 'LaporanController@index');
	Route::get('/laporans/search', 'LaporanController@search')->name('laporans.search');
	Route::get('/exportLaporanPdf', 'LaporanController@exportLaporanPdf');
	Route::get('/exportLaporanExcel', 'LaporanController@exportDataExcel');

	Route::resource('productsIn', 'ProductMasukController');
	Route::get('/apiProductsIn', 'ProductMasukController@apiProductsIn')->name('api.productsIn');
	Route::get('/exportProductMasukAll', 'ProductMasukController@exportProductMasukAll')->name('exportPDF.productMasukAll');
	Route::get('/exportProductMasukAllExcel', 'ProductMasukController@exportExcel')->name('exportExcel.productMasukAll');
	Route::get('/exportProductMasuk/{id}', 'ProductMasukController@exportProductMasuk')->name('exportPDF.productMasuk');

	Route::resource('user', 'UserController');
	Route::get('/apiUser', 'UserController@apiUsers')->name('api.users');
});
