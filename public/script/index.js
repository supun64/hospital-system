document.getElementById('Hospital').addEventListener('change', function() {
    var x = this.value.split(",")[0];

    //in case of  user selecting more than one time -> both buttons disabled first then enable one
    document.getElementById('reg_btn').disabled = true;
    document.getElementById('login_btn').disabled = true;

    //console.log('You selected: ', x);

    if (x == 0) {
      document.getElementById('reg_btn').disabled = false;
    } else {
      document.getElementById('login_btn').disabled = false;
    }

  });