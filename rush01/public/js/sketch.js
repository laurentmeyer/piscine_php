var asteroids = [];
//--
function setup()
{
    canvas = createCanvas(1500, 1000);
    canvas.parent('cv_cont');
    //--
    s = new Ship();
    //--
    var i = 0;
    while(++i < 7)
        asteroids.push(createVector(Math.trunc(random(width/10))*10,Math.trunc(random(height/10))*10));
    //--
}

function draw()
{
    background(51);
    //--
    s.update();
    s.show();
    //--
    fill(255,0,100);
    for(var i = 0; i < asteroids.length;i++)
    {
        rect(asteroids[i].x,asteroids[i].y,40,40);
        s.collide(asteroids[i]);
    }
}
//-----------------------------------
function keyPressed()
{
    if(     keyCode == UP_ARROW)
        s.dir(0,-1);
    else if(keyCode == DOWN_ARROW)
        s.dir(0,1);
    else if(keyCode == LEFT_ARROW)
        s.dir(-1,0);
    else if(keyCode == RIGHT_ARROW)
        s.dir(1,0);
    else if(keyCode == ESCAPE)
    {
        console.log('asteroids : ',asteroids);
    }
}