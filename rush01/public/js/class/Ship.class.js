function Ship()
{
    this.pos    = createVector(width/2,height/2);
    this.scl    = {};
    this.scl.x  = 10;
    this.scl.y  = 10;
    this.mov    = {};
    this.mov.x  = this.pos.x;
    this.mov.y  = this.pos.y;

    this.update = function()
    {
        if(this.pos.x < this.mov.x)
            this.pos.x++;
        else if(this.pos.x > this.mov.x)
            this.pos.x--;
        if(this.pos.y < this.mov.y)
            this.pos.y++;
        else if(this.pos.y > this.mov.y)
            this.pos.y--;
    }

    this.show   = function()
    {
        fill(255);
        rect(this.pos.x, this.pos.y,this.scl.x,this.scl.y);
    }

    this.collide = function(prop)
    {
        if( p5.Vector.dist(this.pos,prop) < this.scl.x + 30)
            console.log("collide");

    }

    this.dir    = function(x,y)
    {
        this.mov.x += this.scl.x * x;
        this.mov.y += this.scl.y * y;

        this.mov.x = constrain(this.mov.x,0,width - this.scl.x);
        this.mov.y = constrain(this.mov.y,0,height - this.scl.y);
    }

} 