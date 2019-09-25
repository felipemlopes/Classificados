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

Route::get('/', ['as' => 'index','uses' => 'IndexController@index']);
Route::get('/pagseguro/session', ['as' => 'index','uses' => 'PagseguroController.php@session']);
Route::post('/pagseguro/notification', ['as' => 'checkout.notification','uses' => 'PagseguroController@checkoutNotification']);

Route::get('login', ['as' => 'login','uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'postlogin','uses' => 'Auth\LoginController@login']);
Route::get('logout', ['as' => 'logout','uses' => 'Auth\LoginController@logout']);
Route::get('register', ['as'=>'register','uses'=>'Auth\RegisterController@showregister']);
Route::post('register', ['as'=>'postregister','uses' => 'Auth\RegisterController@register']);
Route::get('password/remind', ['as'=>'password.remind','uses'=>'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/remind', ['as'=>'send.password.remind','uses'=>'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}', ['as'=>'password.reset', 'uses'=>'Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset', ['as'=>'password.update','uses'=>'Auth\ResetPasswordController@reset']);

Route::get('cidades/{estado_id}', ['as' => 'cidades','uses' => 'CidadesController@index']);
Route::get('categoria/{categoria_id}', ['as' => 'categoria','uses' => 'CategoriasController@index']);

Route::get('artistas', ['as' => 'artist.index','uses' => 'ArtistsController@index']);
Route::get('artistas/{id}', ['as' => 'artist.show','uses' => 'ArtistsController@show']);
Route::get('profissionais', ['as' => 'professional.index','uses' => 'ProfessionalsController@index']);
Route::get('profissionais/{id}', ['as' => 'professional.show','uses' => 'ProfessionalsController@show']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('anuncio', ['as' => 'advertisement.index','uses' => 'AdvertisementController@create']);
    Route::post('anuncio', ['as' => 'advertisement.post','uses' => 'AdvertisementController@store']);
    Route::get('anuncio/{id}', ['as' => 'advertisement.edit','uses' => 'AdvertisementController@back']);
    Route::post('anuncio/{id}', ['as' => 'advertisement.update','uses' => 'AdvertisementController@update']);
    Route::get('anuncio/{id}/plano', ['as' => 'advertisement.plan','uses' => 'AdvertisementController@plan']);
    Route::post('anuncio/{id}/finalizar', ['as' => 'advertisement.finish','uses' => 'AdvertisementController@choosePlan']);


    Route::post('anuncio/{id}/pagar', ['as' => 'advertisement.plan.pay','uses' => 'AdvertisementController@pagar']);
    Route::get('checkout/sucesso', ['as' => 'checkout.sucess','uses' => 'PagseguroController@checkoutSuccess']);

    Route::get('minha-conta/mensagens', ['as' => 'message.index','uses' => 'MessagesController@index']);
    Route::get('minha-conta/mensagens/{id}', ['as' => 'message.show','uses' => 'MessagesController@show']);
    Route::post('mensagens/{id}/send', ['as' => 'message.send','uses' => 'MessagesController@send']);
    Route::get('minha-conta/mensagens/{id}/excluir', ['as' => 'conversation.delete','uses' => 'MessagesController@delete']);

    Route::post('avaliar/artista/{id}', ['as' => 'review.artist.store','uses' => 'AdvertisementController@storeReviewArtista']);
    Route::post('avaliar/profissional/{id}', ['as' => 'review.professional.store','uses' => 'AdvertisementController@storeReviewProfessional']);
    Route::get('avaliacao/{id}/excluir', ['as' => 'review.delete','uses' => 'AdvertisementController@deleteReview']);

    Route::get('minha-conta', ['as' => 'myaccount.index','uses' => 'MyAccountController@index']);
    Route::get('minha-conta/anuncios', ['as' => 'myaccount.advertisement','uses' => 'MyAccountController@advertisement']);
    Route::get('minha-conta/anuncios/{anuncio_id}/editar', ['as' => 'myaccount.advertisement.edit','uses' => 'MyAccountController@advertisementEdit']);
    Route::post('minha-conta/anuncios/{anuncio_id}/editar', ['as' => 'myaccount.advertisement.update','uses' => 'MyAccountController@advertisementUpdate']);
    Route::get('minha-conta/anuncios/{anuncio_id}/publicar', ['as' => 'myaccount.advertisement.publish','uses' => 'MyAccountController@advertisementPublish']);
    Route::post('minha-conta/anuncios/{anuncio_id}/editar/imagem', ['as' => 'myaccount.advertisement.update.image','uses' => 'MyAccountController@advertisementUpdateImage']);
    Route::get('minha-conta/anuncios/{anuncio_id}/pagar', ['as' => 'myaccount.advertisement.pay','uses' => 'MyAccountController@advertisementPay']);
    Route::get('minha-conta/anuncios/{anuncio_id}/excluir', ['as' => 'myaccount.advertisement.delete','uses' => 'MyAccountController@advertisementDelete']);
    Route::get('minha-conta/configuracoes', ['as' => 'myaccount.settings','uses' => 'MyAccountController@settings']);
    Route::post('minha-conta/configuracoes/editar', ['as' => 'myaccount.settings.update.details','uses' => 'MyAccountController@settingsupdate']);
    Route::post('minha-conta/configuracoes/editar/senha', ['as' => 'myaccount.settings.update.password','uses' => 'MyAccountController@settingsupdatepassword']);
    Route::get('minha-conta/plano', ['as' => 'myaccount.plan','uses' => 'MyAccountController@plan']);
    Route::get('minha-conta/plano/{id}/assinar', ['as' => 'myaccount.plan.subscribe','uses' => 'MyAccountController@planSubscribe']);
    Route::post('minha-conta/plano/{id}/assinar', ['as' => 'myaccount.plan.subscribe.post','uses' => 'MyAccountController@planSubscribePost']);
    Route::get('minha-conta/plano/cancelar', ['as' => 'myaccount.plan.cancel','uses' => 'MyAccountController@planCancel']);
    Route::get('minha-conta/pagamentos', ['as' => 'myaccount.payments','uses' => 'MyAccountController@payments']);
});

Route::group(['middleware' => ['auth','role:Administrador|Gerente|Proprietário'],'prefix' => 'dashboard', 'as' => 'dashboard.'], function() {
    Route::get('/', ['as' => 'index','uses' => 'Dashboard\DashboardController@index']);

    Route::get('profile', ['as' => 'profile','uses' => 'Dashboard\ProfileController@index']);
    Route::post('profile/details/update', ['as' => 'profile.update.details','uses' => 'Dashboard\ProfileController@updateDetails']);
    Route::post('profile/login-details/update', ['as' => 'profile.update.login-details','uses' => 'Dashboard\ProfileController@updateLoginDetails']);

    Route::get('user', ['as' => 'user.list','uses' => 'Dashboard\UsersController@index']);
    Route::get('user/create', ['as' => 'user.create','uses' => 'Dashboard\UsersController@create']);
    Route::post('user/create', ['as' => 'user.store','uses' => 'Dashboard\UsersController@store']);
    Route::get('user/{user_id}/edit', ['as' => 'user.edit','uses' => 'Dashboard\UsersController@edit']);
    Route::post('user/{user_id}/update/details', ['as' => 'user.update.details','uses' => 'Dashboard\UsersController@updateDetails']);
    Route::post('user/{user_id}/update/login-details', ['as' => 'user.update.login-details','uses' => 'Dashboard\UsersController@updateLoginDetails']);      //----------testar
    Route::post('user/{user_id}/update/role', ['as' => 'user.update.role','uses' => 'Dashboard\UsersController@updateRole']);
    Route::post('user/{user_id}/update/permissions', ['as' => 'user.update.permission','uses' => 'Dashboard\UsersController@updatePermissions']);
    Route::post('user/{user_id}/update/plan', ['as' => 'user.update.plan','uses' => 'Dashboard\UsersController@updatePlan']);
    Route::post('user/{user_id}/update/plan/days/add', ['as' => 'user.update.plan.days.add','uses' => 'Dashboard\UsersController@updatePlanDaysAdd']);
    Route::post('user/{user_id}/update/plan/days/remove', ['as' => 'user.update.plan.days.remove','uses' => 'Dashboard\UsersController@updatePlanDaysRemove']);
    Route::delete('user/{user_id}/delete', ['as' => 'user.delete','uses' => 'Dashboard\UsersController@destroy']);

    Route::get('advertisement', ['as' => 'advertisement.list','uses' => 'Dashboard\AdvertisementsController@index']);
    Route::get('advertisement/create', ['as' => 'advertisement.create','uses' => 'Dashboard\AdvertisementsController@create']);
    Route::post('advertisement/store', ['as' => 'advertisement.store','uses' => 'Dashboard\AdvertisementsController@store']);
    Route::get('advertisement/{advertisement_id}/edit', ['as' => 'advertisement.edit','uses' => 'Dashboard\AdvertisementsController@edit']);
    Route::post('advertisement/{advertisement_id}/update', ['as' => 'advertisement.update','uses' => 'Dashboard\AdvertisementsController@update']);
    Route::post('advertisement/{advertisement_id}/update-image', ['as' => 'advertisement.updateimage','uses' => 'Dashboard\AdvertisementsController@updateImage']);
    Route::delete('advertisement/{advertisement_id}/delete', ['as' => 'advertisement.destroy','uses' => 'Dashboard\AdvertisementsController@destroy']);

    Route::get('payment', ['as' => 'payment.list','uses' => 'Dashboard\PaymentsController@index']);
    Route::get('payment/{payment_id}', ['as' => 'payment.show','uses' => 'Dashboard\PaymentsController@show']);

    Route::get('musicstyle', ['as' => 'musicstyle.list','uses' => 'Dashboard\MusicStylesController@index']);
    Route::get('musicstyle/create', ['as' => 'musicstyle.create','uses' => 'Dashboard\MusicStylesController@create']);
    Route::post('musicstyle/store', ['as' => 'musicstyle.store','uses' => 'Dashboard\MusicStylesController@store']);
    Route::get('musicstyle/{musicstyle_id}/edit', ['as' => 'musicstyle.edit','uses' => 'Dashboard\MusicStylesController@edit']);
    Route::post('musicstyle/{musicstyle_id}/update', ['as' => 'musicstyle.update','uses' => 'Dashboard\MusicStylesController@update']);
    Route::delete('musicstyle/{musicstyle_id}/delete', ['as' => 'musicstyle.destroy','uses' => 'Dashboard\MusicStylesController@destroy']);

    Route::get('category', ['as' => 'category.list','uses' => 'Dashboard\CategoriesController@index']);
    Route::get('category/create', ['as' => 'category.create','uses' => 'Dashboard\CategoriesController@create']);
    Route::post('category/store', ['as' => 'category.store','uses' => 'Dashboard\CategoriesController@store']);
    Route::get('category/{category_id}/edit', ['as' => 'category.edit','uses' => 'Dashboard\CategoriesController@edit']);
    Route::post('category/{category_id}/update', ['as' => 'category.update','uses' => 'Dashboard\CategoriesController@update']);
    Route::delete('category/{category_id}/delete', ['as' => 'category.destroy','uses' => 'Dashboard\CategoriesController@destroy']);

    Route::get('review', ['as' => 'review.list','uses' => 'Dashboard\ReviewsController@index']);
    Route::get('review/{review_id}/edit', ['as' => 'review.edit','uses' => 'Dashboard\ReviewsController@edit']);
    Route::post('review/{review_id}/update', ['as' => 'review.update','uses' => 'Dashboard\ReviewsController@update']);
    Route::delete('review/{review_id}/delete', ['as' => 'review.destroy','uses' => 'Dashboard\ReviewsController@destroy']);


    Route::get('plan', ['as' => 'plan.list','uses' => 'Dashboard\PlansController@index']);
    Route::get('plan/create', ['as' => 'plan.create','uses' => 'Dashboard\PlansController@create']);
    Route::post('plan/store', ['as' => 'plan.store','uses' => 'Dashboard\PlansController@store']);
    Route::get('plan/{plan_id}/edit', ['as' => 'plan.edit','uses' => 'Dashboard\PlansController@edit']);
    Route::post('plan/{plan_id}/update', ['as' => 'plan.update','uses' => 'Dashboard\PlansController@update']);
    Route::delete('plan/{plan_id}/delete', ['as' => 'plan.destroy','uses' => 'Dashboard\PlansController@destroy']);

    Route::get('role', ['as' => 'role.index','uses' => 'Dashboard\RolesController@index']);
    Route::get('role/create', ['as' => 'role.create','uses' => 'Dashboard\RolesController@create']);
    Route::post('role/store', ['as' => 'role.store','uses' => 'Dashboard\RolesController@store']);
    Route::get('role/{role_id}/edit', ['as' => 'role.edit','uses' => 'Dashboard\RolesController@edit']);
    Route::post('role/{role_id}/update', ['as' => 'role.update','uses' => 'Dashboard\RolesController@update']);
    Route::delete('role/{role_id}/delete', ['as' => 'role.delete','uses' => 'Dashboard\RolesController@destroy']);

    Route::get('permission', ['as' => 'permission.index','uses' => 'Dashboard\PermissionsController@index']);
    Route::get('permission/create', ['as' => 'permission.create','uses' => 'Dashboard\PermissionsController@create']);
    Route::post('permission/store', ['as' => 'permission.store','uses' => 'Dashboard\PermissionsController@store']);
    Route::get('permission/{permission_id}/edit', ['as' => 'permission.edit','uses' => 'Dashboard\PermissionsController@edit']);
    Route::post('permission/{permission_id}/update', ['as' => 'permission.update','uses' => 'Dashboard\PermissionsController@update']);
    Route::delete('permission/{permission_id}/delete', ['as' => 'permission.destroy','uses' => 'Dashboard\PermissionsController@destroy']);

    Route::get('settings', ['as' => 'settings.general','uses' => 'Dashboard\SettingsController@general']);
    Route::post('settings/general', ['as' => 'settings.general.update','uses' => 'Dashboard\SettingsController@updategeneral']);
    Route::get('settings/pagseguro', ['as' => 'settings.pagseguro','uses' => 'Dashboard\SettingsController@pagseguro']);
    Route::post('settings/pagseguro', ['as' => 'settings.pagseguro.update','uses' => 'Dashboard\SettingsController@updatepagseguro']);
    Route::get('settings/auth', ['as' => 'settings.auth','uses' => 'Dashboard\SettingsController@auth']);
    Route::post('settings/auth', ['as' => 'settings.auth.update','uses' => 'Dashboard\SettingsController@updateauth']);
});
