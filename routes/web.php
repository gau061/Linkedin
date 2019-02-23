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

/* -------------------------------------------- */
/* user signup */
/* -------------------------------------------- */
Route::get('/signup', ['as' => 'user.signup', 'uses' => 'UserController@user_signup']);
Route::post('/signup/post', ['as' => 'signup.post', 'uses' => 'UserController@store']);
/* -------------------------------------------- */
/* Activation */
/* -------------------------------------------- */
Route::get('activation/{token}', ['as' => 'activation', 'uses' => 'UserController@activation']);
/* -------------------------------------------- */
/*  Pages */
/* -------------------------------------------- */
Route::get('/p/{slug}', ['as' => 'p.index', 'uses' => 'Admin\PageController@dynamic_page']);
/* -------------------------------------------- */
/* Frontuser */
/* -------------------------------------------- */
Route::group(['middleware' => 'signin-check'], function () {
	/* -------------------------------------------- */
	/* user login */
	/* -------------------------------------------- */
	Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
	Route::get('/signin', ['as' => 'user.login', 'uses' => 'UserAuth\AuthController@login_form']);
	Route::post('/signin/post', ['as' => 'signin.post', 'uses' => 'UserAuth\AuthController@login']);
	/* -------------------------------------------- */
	/* reset password */
	/* -------------------------------------------- */
	Route::get('reset/password', ['as' => 'email.form', 'uses' => 'UserAuth\ForgotPasswordController@emailForm']);
	Route::post('send/email', ['as' => 'email.send', 'uses' => 'UserAuth\ForgotPasswordController@token_gen']);
	Route::get('reset/user/{token}', ['as' => 'pwd.token', 'uses' => 'UserAuth\ResetPasswordController@password_reset_form']);
	Route::patch('update/password/{token}', ['as' => 'pwd.update', 'uses' => 'UserAuth\ResetPasswordController@updatePassword']);

});
/* ----- Check User Login ----- */
Route::group(['middleware' => 'users'], function () {
	/* -------------------------------------------- */
	/*  User Profile */
	/* -------------------------------------------- */
	Route::get('/user/{slug}', ['as' => 'profile.fill', 'uses' => 'UserController@formOpen']);
	Route::post('/user/details/{slug}', ['as' => 'profile.fill.user', 'uses' => 'UserController@fillUser']);

	Route::group(['middleware' => 'profile-fill'], function () {
		/* -------------------------------------------- */
		/*  Post Feed */
		/* -------------------------------------------- */
		Route::get('/feed', ['as' => 'feeds', 'uses' => 'FeedController@index']);
		Route::post('/feed/post', ['as' => 'feed.store', 'uses' => 'FeedController@store']);
		Route::patch('/feed/post/{id}', ['as' => 'feed.update', 'uses' => 'FeedController@update']);
		Route::post('/feed/comment', ['as' => 'feed.comment', 'uses' => 'FeedController@comment']);
		Route::get('/feed/like', ['as' => 'feed.like', 'uses' => 'FeedController@like']);
		Route::get('/feed/article/new', ['as' => 'feed.article.new', 'uses' => 'FeedController@articleCreate']);
		Route::get('/article/{id}', ['as' => 'feed.article', 'uses' => 'FeedController@article']);
		Route::post('/feed/article/create', ['as' => 'feed.article.insert', 'uses' => 'FeedController@articleInsert']);
		Route::get('/feed/remove', ['as' => 'feed.remove', 'uses' => 'FeedController@feedRemove']);
		Route::get('/feed/share', ['as' => 'feed.share', 'uses' => 'FeedController@share']);
		Route::post('/feed/post-share', ['as' => 'feed.post.share', 'uses' => 'FeedController@feedshare']);

		/* -------------------------------------------- */
		/*  Group Post Feed */
		/* -------------------------------------------- */

		// Route::get('groupfeed',['as'=>'groupfeeds','uses'=>'GroupFeedController@index']);

		Route::post('/groupfeed/post', ['as' => 'groupfeed.store', 'uses' => 'GroupFeedController@store']);
		Route::post('/groupfeed/comment', ['as' => 'groupfeed.comment', 'uses' => 'GroupFeedController@groupcomment']);
		Route::get('/groupfeed/like', ['as' => 'groupfeed.like', 'uses' => 'GroupFeedController@grouplike']);
		Route::get('/groupfeed/remove', ['as' => 'groupfeed.remove', 'uses' => 'GroupFeedController@groupfeedRemove']);

		/* -------------------------------------------- */
		/* Timeline */
		/* -------------------------------------------- */
		Route::get('timeline/{id?}', ['as' => 'timeline.index', 'uses' => 'FeedController@timeline']);
		/* -------------------------------------------- */
		/* User Profile */
		/* -------------------------------------------- */
		// Route::get('/feed',['as'=>'feeds','uses'=>'UserController@index']);
		Route::get('/profile/{slug}', ['as' => 'profile', 'uses' => 'UserController@profile']);
		Route::patch('/profile/update/{id}', ['as' => 'profile.update', 'uses' => 'UserController@profileUpdate']);
		Route::post('/user/skills', ['as' => 'userskills.store', 'uses' => 'UserController@userSkills']);
		Route::get('/user/skills/remove/{id}', ['as' => 'user.skills.remove', 'uses' => 'UserController@skillsRemove']);
		/* -------------------------------------------- */
		/* Request Controller AND Details */
		/* -------------------------------------------- */
		Route::get('/request/{slug}/{request_id}', ['as' => 'request.send', 'uses' => 'RequestController@request']);
		Route::get('/reqstatus/{status}/{sender_id}', ['as' => 'request.status', 'uses' => 'RequestController@status']);
		/* -------------------------------------------- */
		/* Experience */
		/* -------------------------------------------- */
		Route::post('experience/store', ['as' => 'experience.store', 'uses' => 'UserController@experince']);
		Route::patch('experience/update/{id}', ['as' => 'experience.update', 'uses' => 'UserController@experinceUpdate']);
		Route::get('experince/delete/{id}', ['as' => 'experince.delete', 'uses' => 'UserController@experinceDelete']);
		/* -------------------------------------------- */
		/* education */
		/* -------------------------------------------- */
		Route::post('education/store', ['as' => 'education.store', 'uses' => 'UserController@education']);
		Route::patch('education/update/{id}', ['as' => 'education.update', 'uses' => 'UserController@eduUpdate']);
		Route::get('education/delete/{id}', ['as' => 'education.delete', 'uses' => 'UserController@educationDelete']);
		/* -------------------------------------------- */
		/* Prpfiel Image Upload */
		/* -------------------------------------------- */
		Route::post('profile/cover/{slug}', ['as' => 'cover.image', 'uses' => 'UserController@profile_cover']);
		/* -------------------------------------------- */
		/*  Connection */
		/* -------------------------------------------- */
		Route::get('connection/', ['as' => 'connection.index', 'uses' => 'ConnectionController@index']);
		Route::get('connection/search', ['as' => 'connection.search', 'uses' => 'ConnectionController@search']);
		Route::get('connected/', ['as' => 'connection.list', 'uses' => 'ConnectionController@connList']);
		Route::get('connectd/list', ['as' => 'connectd.list', 'uses' => 'ConnectionController@connectdList']);
		/* -------------------------------------------- */
		/*  Groups */
		/* -------------------------------------------- */
		Route::get('/group/index/{id}', ['as' => 'groups.index', 'uses' => 'GroupController@groupindex']);
		// Route::get('group/my-groups',['as'=>'group.mygroups','uses'=>'GroupController@mygroups_index']);
		Route::get('group/discover', ['as' => 'group.discover', 'uses' => 'GroupController@discoverGroup']);
		/* create */
		Route::get('group/create', ['as' => 'group.create', 'uses' => 'GroupController@groupCreate']);
		Route::post('group/insert', ['as' => 'group.insert', 'uses' => 'GroupController@groupInsert']);
		/* Select Group*/
		Route::get('group/user-groups', ['as' => 'group.usergroups', 'uses' => 'GroupController@groupSelect']);
		/* Manage Group */
		Route::get('group/manage/{id}/{slug?}', ['as' => 'group.manage', 'uses' => 'GroupController@groupManage']);
		Route::put('group/update/{id}', ['as' => 'group.update', 'uses' => 'GroupController@groupUpdate']);
		/*Invite User*/
		Route::get('invite/user/', ['as' => 'invite.user', 'uses' => 'GroupController@searchuser']);
		Route::post('group/member/invite', ['as' => 'groupmember.invite', 'uses' => 'GroupController@groupMemberInvite']);
		/*groupjoin*/
		Route::get('joingroup/{slug}/{gid}', ['as' => 'joingroup.request', 'uses' => 'GroupRequestController@joingrouprequest']);

		Route::get('joingroupstatus/{status}/{gid}/{requestuid}/{token?}', ['as' => 'joingroup.status', 'uses' => 'GroupRequestController@joingroupstatus']);

		/*Delete Group*/
		Route::get('group/delete/{id}', ['as' => 'group.delete', 'uses' => 'GroupController@groupDelete']);

		/* Group Notification */
		Route::get('group/notification', ['as' => 'group.notification', 'uses' => 'GroupController@groupnotification']);

		/*Remove Group Member*/
		Route::get('groupmember/remove/{gid}/{uid}', ['as' => 'groupmember.remove', 'uses' => 'GroupController@groupmemberremove']);

		/*Leave Group*/
		Route::get('leavegroup/{gid}/', ['as' => 'leavegroup', 'uses' => 'GroupController@LeaveGroup']);

		/*groupmemeber profile*/
		Route::get('/memberprofile/{gid}/{slug}', ['as' => 'memberprofile', 'uses' => 'UserController@memberprofile']);

		/*group search*/

		Route::get('/group/search', ['as' => 'group.search', 'uses' => 'GroupController@searchgroup']);

		Route::get('/group/view', ['as' => 'groupview', 'uses' => 'GroupController@searchallgroup']);

		/*group active*/
		Route::get('group/active/{gid}', ['as' => 'group.active', 'uses' => 'GroupController@activegroup']);

		/* -------------------------------------------- */
		/* Message */
		/* -------------------------------------------- */
		Route::get('messages/{id?}', ['as' => 'message.index', 'uses' => 'MessageController@index']);
		Route::post('message/send/{recver_id}', ['as' => 'message.send', 'uses' => 'MessageController@msgSend']);
		Route::get('message/fetch/{data}', ['as' => 'message.fetch', 'uses' => 'MessageController@msgFetch']);
		Route::get('message/delete/{uniqid}', ['as' => 'message.delete', 'uses' => 'MessageController@deleteData']);
		Route::get('/msg/read/{sid}', ['as' => 'msg.read', 'uses' => 'MessageController@msgRead']);
		Route::get('/new/msg/fetch/{id}', ['as' => 'new.msg.fetch', 'uses' => 'MessageController@newMsgFetch']);
		Route::get('/new/msg/status/{id}', ['as' => 'new.msg.status', 'uses' => 'MessageController@newMsgStatus']);
		/* -------------------------------------------- */
	});
	/* -------------------------------------------- */
	/* logout */
	/* -------------------------------------------- */
	Route::get('/logout', ['as' => 'user.logout', 'uses' => 'UserAuth\AuthController@logout']);
});

/* ---------------------------------------------------------------- */
/* ----------==========----- ADMIN ROUTES -----==========---------- */
/* ---------------------------------------------------------------- */
Route::group(['middleware' => 'login-check'], function () {
	Route::get('/admin', ['as' => 'login', 'uses' => 'Auth\LoginController@show_form']);
	Route::post('/admin/post', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login_post']);
});
/* -------------------------------------------- */
Route::get('/password/form', ['as' => 'password.form', 'uses' => 'Auth\ForgotPasswordController@pwd_form']);
Route::post('/password/form', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@token_gen']);
Route::get('/password/reset/{token}', ['as' => 'password.token', 'uses' => 'Auth\ResetPasswordController@password_reset_form']);
Route::patch('/password/update', ['as' => 'password.update', 'uses' => 'Auth\ResetPasswordController@updatePassword']);
/* -------------------------------------------- */
Route::get('contact', ['as' => 'contact', 'uses' => 'UserController@contact']);
Route::post('/contacts/post', ['as' => 'contact.post', 'uses' => 'UserController@contact_post']);
/* -------------------------------------------- */
Route::group(['middleware' => 'admin-check', 'prefix' => 'admin'], function () {
	/* -------------------------------------------- */
	/* Roles Route */
	/* -------------------------------------------- */
	Route::get('roles', ['as' => 'roles.index', 'uses' => 'RoleController@index', 'middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('roles/create', ['as' => 'roles.create', 'uses' => 'RoleController@create', 'middleware' => ['permission:role-create']]);
	Route::post('roles/create', ['as' => 'roles.store', 'uses' => 'RoleController@store', 'middleware' => ['permission:role-create']]);
	Route::get('roles/{id}', ['as' => 'roles.show', 'uses' => 'RoleController@show']);
	Route::get('roles/{id}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit', 'middleware' => ['permission:role-edit']]);
	Route::patch('roles/{id}', ['as' => 'roles.update', 'uses' => 'RoleController@update', 'middleware' => ['permission:role-edit']]);
	Route::get('roles/{id}', ['as' => 'roles.remove', 'uses' => 'RoleController@remove', 'middleware' => ['permission:role-delete']]);
	/* -------------------------------------------- */
	/* Dashboard Route */
	/* -------------------------------------------- */
	Route::get('dashboard', ['as' => 'admin.index', 'uses' => 'Admin\AdminController@dashboard']);
	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
	/* -------------------------------------------- */
	/* User Profiel */
	/* -------------------------------------------- */
	Route::get('user', ['as' => 'user.index', 'uses' => 'Admin\UserController@index']);
	Route::post('user/post', ['as' => 'user.post', 'uses' => 'Admin\UserController@update_profile']);
	Route::post('user/password', ['as' => 'user.password', 'uses' => 'Admin\UserController@update_password']);
	/* -------------------------------------------- */
	/* users */
	/* -------------------------------------------- */
	Route::get('users', ['as' => 'users.index', 'uses' => 'Admin\UsersController@index']);
	Route::get('users/create', ['as' => 'users.create', 'uses' => 'Admin\UsersController@create']);
	Route::post('users/store', ['as' => 'users.store', 'uses' => 'Admin\UsersController@store']);
	Route::get('users/edit/{id}', ['as' => 'users.edit', 'uses' => 'Admin\UsersController@edit']);
	Route::patch('users/update/{id}', ['as' => 'users.update', 'uses' => 'Admin\UsersController@update']);
	Route::get('users/delete/{id}', ['as' => 'users.delete', 'uses' => 'Admin\UsersController@destroy']);
	Route::get('users/show/{id}', ['as' => 'users.show', 'uses' => 'Admin\UsersController@show']);
	/* -------------------------------------------- */
	/* Skills */
	/* -------------------------------------------- */
	Route::get('skills', ['as' => 'skills.index', 'uses' => 'Admin\SkillController@index']);
	Route::post('skills/store', ['as' => 'skills.store', 'uses' => 'Admin\SkillController@store']);
	Route::patch('skills/update/{id}', ['as' => 'skills.update', 'uses' => 'Admin\SkillController@update']);
	Route::get('skills/remove/{id}', ['as' => 'skills.remove', 'uses' => 'Admin\SkillController@remove']);
	/* -------------------------------------------- */
	/*  Create Page Route */
	/* -------------------------------------------- */
	Route::get('pages/create', ['as' => 'page.index', 'uses' => 'Admin\PageController@page_index']);
	Route::post('pages/store', ['as' => 'page.store', 'uses' => 'Admin\PageController@page_create']);
	/* -------------------------------------------- */
	/*  Dynamic Page */
	/* -------------------------------------------- */
	Route::get('pages/{slug}', ['as' => 'pages.index', 'uses' => 'Admin\PageController@pages']);
	Route::patch('pages/update/{slug}', ['as' => 'pages.update', 'uses' => 'Admin\PageController@pages_update']);
	Route::get('pages/delete/{id}', ['as' => 'pages.delete', 'uses' => 'Admin\PageController@delete_pages']);
	/* -------------------------------------------- */
	/*  Menus Header And Footer */
	/* -------------------------------------------- */
	Route::get('menu/index', ['as' => 'menus.index', 'uses' => 'Admin\MenuController@index']);
	Route::post('menu/store/{slug}', ['as' => 'menus.store', 'uses' => 'Admin\MenuController@store']);
	/* -------------------------------------------- */
	/* Site Settings */
	/* -------------------------------------------- */
	Route::get('settings/index', ['as' => 'settings.index', 'uses' => 'Admin\SettingsController@index']);
	Route::post('settings/update', ['as' => 'settings.update', 'uses' => 'Admin\SettingsController@update']);
	/* -------------------------------------------- */
	/* Frount user */
	/* -------------------------------------------- */
	Route::get('frontuser/index', ['as' => 'frontuser.index', 'uses' => 'Admin\FrontuserController@index']);
	Route::get('frontuser/show/{id}', ['as' => 'frontuser.show', 'uses' => 'Admin\FrontuserController@show']);
	Route::get('frontuser/delete/{id}', ['as' => 'frontuser.delete', 'uses' => 'Admin\FrontuserController@delete']);
	Route::get('frontuser/fus/{id}/{sid}', ['as' => 'front.status', 'uses' => 'Admin\FrontuserController@change_status']);
	/* -------------------------------------------- */
	/* Contact Us Page */
	/* -------------------------------------------- */
	Route::get('contact/index', ['as' => 'contact.index', 'uses' => 'Admin\PageController@contact_index']);
	Route::post('contact/update', ['as' => 'contact.update', 'uses' => 'Admin\PageController@contact_update']);
	/* -------------------------------------------- */

	/* Industry page */
	/* -------------------------------------------- */
	Route::get('Industry/index', ['as' => 'industry.index', 'uses' => 'Admin\IndustryController@industry_index']);
	Route::post('Industry/insert', ['as' => 'industry.insert', 'uses' => 'Admin\IndustryController@industry_insert']);

	//select data
	Route::get('display/industry', ['as' => 'industry.display', 'uses' => 'Admin\IndustryController@industry_display']);

	//update data
	Route::get('industry/edit/{id}', ['as' => 'industry.edit', 'uses' => 'Admin\IndustryController@editIndustry']);
	Route::put('industry/update/{id}', ['as' => 'industry.update', 'uses' => 'Admin\IndustryController@update']);
	//delete
	Route::get('industry/delete/{id}', ['as' => 'industry.delete', 'uses' => 'Admin\IndustryController@show']);
	/* END industry Route */
	/* -------------------------------------------- */
});
