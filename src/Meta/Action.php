<?php
namespace Maulana20\Meta;

class Action {
	// Akun Pengguna GOJEK
	const loginPhone = 'v3/customers/login_with_phone';
	const loginGojek = 'v3/customers/token';
	const checkBalance = 'wallet/profile';
	const getCustomer = 'gojek/v2/customer';
	const editAccount = 'gojek/v2/customer/edit/v2';
	const logout = 'v3/auth/token';
	
	// Akun Pengguna GOPAY
	const gopayTransfer = 'v2/fund/transfer';
	const gopayDetail = 'wallet/profile/detailed';
}
