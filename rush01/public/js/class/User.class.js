function User()
{
    var self = this;
    
    this.login = function()
    {
        return new Promise(function(resolve,reject)
        {
            window.axios.post('/api/user/login.php').then(function(res)
            {
                console.info("already login ? : ",+res.data.id);
                
                if(!+res.data.id)
                {
                    window.swal(
                    {
                        title: 'Please login',
                        html:
                        '<input id="login" onchange=\'window.login = document.querySelector("#login").value\' placeholder="username" class="swal2-input" autofocus>' +
                        '<input id="password" onchange=\'window.password = document.querySelector("#password").value\' placeholder="password" class="swal2-input">',
                        showCancelButton: true,
                        allowOutsideClick: false,
                        confirmButtonText: 'Register',
                        cancelButtonText: 'Login',
                        preConfirm: function()
                        {
                            return new Promise(function (ok)
                            {
                                ok(
                                [
                                    window.login,
                                    window.password
                                ]);
                            });
                        }
                    })
                    //regiser
                    .then(function()
                    {
                        self.credentials(resolve,reject,'register');
                    })
                    //login
                    .catch(function()
                    {
                        self.credentials(resolve,reject,'login');
                    });
                }
                else
                {
                    resolve();
                }
            })
        });
    }

    this.credentials    = function(resolve,reject,action)
    {
        console.log(login,password);

        var params = new URLSearchParams();
        params.append('user',login);
        params.append('password',password);
        
        axios.post('/api/user/' + action + '.php',params)
        .then(function(res)
        {
            console.log(res.data);
            if(!res.data.id)
            {
                reject();
            }
            else
            {
                resolve();
            }
        });
    }
}