function Lobby()
{
    var self = this;
    var lobby = {};
    var done = ()=>{};

    this.start = function(cb)
    {
        cb ? self.done = cb : false ;
        window.swal(
        {
            title: 'Welcome to warhammer 40k',
            text: "",
            type: 'info',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Join !',
            cancelButtonText: 'Create !',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true
        })
        .then(function()
        {
            self.join();
        },
        function(dismiss)
        {
            // dismiss can be 'cancel', 'overlay', 'close', and 'timer'
            if (dismiss === 'cancel')
            {
                self.create();
            }
        });
    }

    this.create = function()
    {
        lobby.action = "create";
        self.type();
    }

    this.join = function()
    {
        console.log("-------join-------");
        lobby.action = 'join';
        window.axios.get('/api/lobby/lobby.php')
        .then(function(res)
        {
            var selectedLobby = null;
            var ul = document.createElement('ul');
            ul.style.listStyleType = "none";
            ul.classList.add('lobbys');
            console.info(res.data);
            if(!res.data.current_lobby || !res.data.hasOwnProperty(res.data.currentTransform))
            {
                window.swal(
                {
                    title: 'No lobbys are availible',
                    text: ':(',
                    type: 'error',
                    allowOutsideClick: false,
                    confirmButtonText : 'SAD :('
                }).then(function()
                {
                    self.start();
                });
            }
            else
            {
                for(var lobbys in res.data)
                {
                    if(res.data[lobbys] != null && res.data[lobbys].hasOwnProperty('players'))
                    {
                        var li = document.createElement('li');
                        li.style.border = "1px solid grey";
                        li.classList.add('lobby');
                        li.setAttribute('id',lobbys);
                        var text = Object.keys(res.data[lobbys].players).length + "/" + res.data[lobbys].max_players + " players";
                        
                        li.innerText = text;
                        ul.appendChild(li);
                    }
                }
                window.swal(
                {
                    title: 'Lobbys',
                    html: ul.outerHTML,
                    allowOutsideClick: false,
                    preConfirm: function ()
                    {
                        return new Promise(function (resolve, reject)
                        {
                            if(!selectedLobby)
                                reject('please select a lobby');
                            else
                                resolve();
                        });
                    }
                });
    
                document.querySelector('body').addEventListener('click',function(ev)
                {
                    if(ev.target.classList.contains('lobby'))
                    {
                        lobby.lobby = ev.target.getAttribute('id');
                        window.swal.close();
                        self.faction();
                    }
                });
            }

        });
    };

    this.type = function()
    {
        return window.swal(
        {
            title: 'Choose FFA or TEAM',
            text: "(ffa ftw)",
            type: 'info',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'FFA !',
            cancelButtonText: 'TEAM !',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true
        })
        .then(function()
        {
            lobby.type = "FFA";
            self.size();
        },
        function(dismiss)
        {
            //dismiss can be 'cancel', 'overlay', 'close', and 'timer'
            if(dismiss === 'cancel')
            {
                lobby.type = "TEAM";
                self.size();
            }
        });
    }

    this.size = function()
    {
        window.swal(
        {
            title: 'Select the game size',
            input: 'select',
            inputOptions:
            {
                'LIT': 'minimal (recommanded)',
                'AVG': 'average',
                'BIG': 'big fat long game'
            },
            inputPlaceholder: 'Select the game size',
            showCancelButton: false,
            allowOutsideClick: false,
            inputValidator: function (value)
            {
                return new Promise(function (resolve, reject)
                {
                    if (value)
                    {
                        resolve()
                    }
                    else
                    {
                        reject('You need to select a value :)')
                    }
                });
            }
        })
        .then(function(result)
        {
            lobby.size = result;
            self.maxplayer();
        }); 
    }
    
    this.maxplayer = function()
    {
        if(lobby.type === 'FFA')
        {
            window.swal(
            {
                title: 'Select the maximum player',
                input: 'select',
                inputOptions:
                {
                    '2': '2 players',
                    '3': '3 players',
                    '4': '4 players'
                },
                inputPlaceholder: 'Select the maximum player',
                showCancelButton: false,
                allowOutsideClick: false,
                inputValidator: function (value)
                {
                    return new Promise(function (resolve, reject)
                    {
                        if (value)
                        {
                            resolve()
                        }
                        else
                        {
                            reject('You need to select a value :)')
                        }
                    });
                }
            })
            .then(function(result)
            {
                lobby.max_players = result;
                self.faction();
            }); 
        }
        else
        {
            lobby.max_players = "4";
            self.faction();
        }
    }

    this.faction = function()
    {
        window.swal(
        {
            title: 'Select your faction',
            input: 'select',
            inputOptions:
            {
                'ORK': 'ORK!',
                'SPM': 'SPACE MARINE',
                'LDR': 'ELDAR'
            },
            inputPlaceholder: 'Select your faction',
            showCancelButton: false,
            allowOutsideClick: false,
            inputValidator: function (value)
            {
                return new Promise(function (resolve, reject)
                {
                    if (value)
                    {
                        resolve();
                    }
                    else
                    {
                        reject('You need to select a value :)');
                    }
                });
            }
        })
        .then(function(result)
        {
            lobby.faction = result;
            self.send();
        });
    };
    
    this.send = function()
    {
        var params = new window.URLSearchParams();
        for(var key in lobby)
            params.append(key,lobby[key]);
        
        console.log('sent:', lobby);
        window.axios.post('/api/lobby/lobby.php',params).then(function(res)
        {
            console.log(res.data);
            if(res.data.current_lobby)
            {
                self.fleet();
            }
            else
                console.error('no current_lobby: ',res.data);
        });
    };
    
    this.fleet = function()
    {
        var rdyInterval = null;
        
        window.swal(
        {
            title: 'Waiting for other players',
            text: 'Choose your fleet',
            input: 'select',
            inputOptions:
            {
                'LW': 'minimal (recommanded)',
                'MW': 'medium ',
                'HW': 'heavy '
            },
            showCancelButton: false,
            confirmButtonText: 'READY!',
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            preConfirm: function(value)
            {
                return new Promise(function (resolve, reject)
                {
                    var params = new window.URLSearchParams();
                    params.append('action','ready');
                    params.append('fleet',value);
                    
                    window.axios.post('/api/lobby/lobby.php',params).then(function(rdy)
                    {
                        console.log("you sent your fleet: ",rdy.data);
                        if(rdy.data[rdy.data.current_lobby].status == "ready" && (Object.keys(rdy.data[rdy.data.current_lobby].players_ready).length == rdy.data[rdy.data.current_lobby].max_players))
                        {
                            var params = new window.URLSearchParams();
                            params.append('action','delete');
                            params.append('lobby',rdy.data.current_lobby);
                            
                            resolve();
                            setTimeout(function()
                            {
                                window.axios.post('/api/lobby/lobby.php',params)
                                .then(function(res){});
                            }, 10000);
                        }
                        else
                        {
                            rdyInterval = setInterval(function()
                            {
                                console.log(rdyInterval);
                                window.axios.get('/api/lobby/lobby.php').then(function(lobbys)
                                {
                                    console.log("checking readystate", lobbys.data);
                                    
                                    if(lobbys.data[lobbys.data.current_lobby].status == "ready" && (Object.keys(lobbys.data[lobbys.data.current_lobby].players_ready).length == lobbys.data[lobbys.data.current_lobby].max_players))
                                    {
                                        clearInterval(rdyInterval);
                                        var params = new window.URLSearchParams();
                                        params.append('action','delete');
                                        params.append('lobby',lobbys.data.current_lobby);
                                        
                                        resolve();
                                        setTimeout(function()
                                        {
                                            window.axios.post('/api/lobby/lobby.php',params)
                                            .then(function(res){});
                                        },10000);
                                    }
                                });
                            }, 2000);
                        }
                    });

                });
            }})
            .then(function()
            {
                window.swal(
                {
                    type: 'success',
                    title: 'Ajax request finished!',
                    html: 'bite'
                }).then(self.done);
            });
    }
    
}