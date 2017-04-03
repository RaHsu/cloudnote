function checkR() {
	var form = document.getElementById('zhuce');
	var reg = /^[0-9a-z]{6,}/gi;
	var pass = document.getElementsByName('password');
	var mytest = pass[0].value;
	var con = document.getElementsByName('confirm');
	var mycon = con[0].value;
	var user = document.getElementsByName('username');
	var myname = user[0].value;
	if(myname == '') {
		swal('用户名不能为空');
		return false;
	}
	if(reg.test(mytest) == false) {
		swal("你的密码不合法，请输入6位以上只含有数字和字母的密码");
		return false;
	} else if(mycon != mytest) {
		swal("两次密码输入不一致");
		return false;
	} else {
		form.submit();
		
	}
}