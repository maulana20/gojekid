<?php
namespace Maulana20\Meta;

class Action {
	// Akun Pengguna GOJEK
	const loginPhone = 'v3/customers/login_with_phone';
	const loginEmail = 'v3/customers/login_with_email';
	const loginAuth = 'v3/customers/token';
	const checkBalance = 'wallet/profile';
	const getCustomer = 'gojek/v2/customer';
	const editAccount = 'gojek/v2/customer/edit/v2';
	const logout = 'v3/auth/token';
	
	// Akun Pengguna GOPAY
	const gopayDetail = 'wallet/profile/detailed';
	const gopayHistory = 'wallet/history';
	const gopayWalletCode = 'wallet/qr-code';
	const gopayTransfer = 'v2/fund/transfer';
	
	// Data Booking GOJEK
	const bookingHistory = 'gojek/v2/booking/history';
	const bookingActive = 'v1/customers/active_bookings';
	const bookingByOrder = 'gojek/v2/booking/findByOrderNo';
	const calculate = 'gojek/v2/calculate/gopay';
	
	// Data GOFOOD
	const gofoodHome = 'gofood/consumer/v2/home';
	const gofoodNearby = 'gojek/merchant/find';
	const gofoodRestaurant = 'gofood/consumer/v2/restaurants';
	
	// Data Area GORIDE GOCAR GOFOOD GOMART
	const areaLocation = 'gojek/poi/reverse-geocode';
	const gorideNearby = 'gojek/service_type/1/drivers/nearby';
	const gocarNearby = 'gojek/service_type/13/drivers/nearby';
	const gosendNearby = 'gojek/service_type/14/drivers/nearby';
	const gomartNearby = 'gojek/mart-category/listMartNearest';
	
	// Data GOPOINTS
	const gopointBalance = 'gopoints/v1/wallet/points-balance';
	const gopointNext = 'gopoints/v1/next-points-token';
	const gopointReedem = 'gopoints/v1/redeem-points-token';
}
