class Box{
    constructor(x,y,w,h){
        this.x=x;
        this.y=y;
        this.w=w;
        this.h=h;

    }
    draw(ctx){
        ctx.fillStyle = "white";
        ctx.fillRect(this.x,this.y,this.w,this.h)
        ctx.strokeStyle = "#cccccc";
        ctx.strokeRect(this.x,this.y,this.w,this.h)
    }
}


class Label{
    constructor(text,x,y,font_size){
        this.x=x;
        this.y=y;
        this.text=text;
        this.font_size=font_size;
    }
    draw(ctx){
        ctx.fillStyle = "black";
        ctx.font = this.font_size+"px  Comic Sans MS";
        ctx.fillText(this.text,this.x,this.y)
    }
}


function get_context(id,width,height){
            var elem = document.getElementById(id);
            elem.style.width = width;
            elem.style.height = height;
            elem.width = width;
            elem.height = height;
            var ctx = elem.getContext("2d");
            ctx.fillStyle = "#E5E5E5";
            ctx.fillRect(0,0,width,height);

            return ctx
        }
/*
document.getElementById("canvas").onmousemove = function(ev){
    //ev.clientX
}
*/
function redraw(ctx,w=500,h=400){
    ctx.fillStyle = "#E5E5E5";
    ctx.fillRect(0,0,w,h);
}
