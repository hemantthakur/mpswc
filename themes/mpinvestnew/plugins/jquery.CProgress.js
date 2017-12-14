(function(n){n.ns||(n.ns={});n.ns.cprogress=function(t,i){var r=this;r.$el=n(t);r.el=t;r.$el.data("ns.cprogress",r);r.options=n.extend({},n.ns.cprogress.defaultOptions,i);r.methods={init:function(){r.img1=new Image;r.img1.src=r.options.img1;r.img2=new Image;r.img2.src=r.options.img2;r.width=r.img1.width;r.height=r.img1.height;r.$progress=n("<div />").addClass("jCProgress");mt=parseInt(r.$progress.css("marginTop").replace("ems",""));ml=parseInt(r.$progress.css("marginLeft").replace("ems",""));r.$progress.css("marginLeft",(r.$el.width()-r.width)/2+ml).css("marginTop",(r.$el.height()-r.height)/2+mt).css("opacity","0.0");r.$percent=n("<div />").addClass("percent");r.$ctx=n("<canvas />");r.$ctx.attr("width",r.width);r.$ctx.attr("height",r.height);r.$el.prepend(r.$progress);r.$progress.append(r.$percent);r.$progress.append(r.$ctx);r.$progress.animate({opacity:1},500,function(){});r.ctx=r.$ctx[0].getContext("2d");r.ctx.fillStyle="rgba(0,0,0,0.0)";r.percent=r.options.percent;r.i=r.percent/100*Math.PI*2;r.j=0;r.stop=0;r.options.onInit();r.methods.draw()},reloadImages:function(){r.img1=new Image;r.img1.src=r.options.img1;r.img2=new Image;r.img2.src=r.options.img2;r.width=r.img1.width;r.height=r.img1.height;r.$progress.css("marginLeft",(r.$el.width()-r.width)/2+ml).css("marginTop",(r.$el.height()-r.height)/2+mt);r.$ctx.attr("width",r.width);r.$ctx.attr("height",r.height);r.ctx=r.$ctx[0].getContext("2d");r.ctx.fillStyle="rgba(0,0,0,0.0)"},coreDraw:function(){r.ctx.clearRect(0,0,r.width,r.height);r.ctx.save();r.ctx.drawImage(r.img1,0,0);r.ctx.beginPath();r.ctx.lineWidth=5;r.ctx.arc(52,53,60,r.i-Math.PI/2,r.j-Math.PI/2,!0);r.ctx.lineTo(52,52);r.ctx.closePath();r.ctx.fill();r.ctx.clip();r.ctx.drawImage(r.img2,0,0);r.ctx.restore()},draw:function(){if(r&&(r.options.showPercent==!1?r.$percent.hide():r.$percent.show(),r.stop!=1&&r.percent-1<=r.options.limit)){if(r.options.loop==!0&&(r.options.limit=121),r.percent>=100&&r.percent<=r.options.limit&&(r.i=0,r.options.limit=r.options.limit-100),r.methods.coreDraw(),r.i+=r.options.PIStep,r.percent=r.i*100/(Math.PI*2),r.percent<=r.options.limit){setTimeout(r.methods.draw,r.options.speed);r.$percent.html(r.options.percentageDisplay(r.percent));r.options.onProgress(r.options.percent.toFixed(0))}else{r.$percent.html(r.options.percentageDisplay(r.options.limit));r.methods.coreDraw();r.options.onProgress(r.options.limit);r.options.onComplete(r.options.limit)}r.percent++}},destroy:function(){r.$progress.animate({opacity:0},500,function(){r.$progress.remove();r.stop=1;r=null})}};r.public_methods={start:function(){r.stop=0;r.methods.draw()},stop:function(){r.stop=1},reset:function(){r.percent=r.options.percent;r.i=0;r.methods.draw()},destroy:function(){r.methods.destroy()},options:function(t){return r.options=n.extend({},r.options,t),(t.img1||t.img2||t.img3)&&(r.methods.reloadImages(),r.methods.coreDraw()),r.methods.draw(),r.options}};r.methods.init()};n.ns.cprogress.defaultOptions={percent:0,img1:"v1.png",img2:"v2.png",speed:50,limit:48,loop:!1,showPercent:!0,PIStep:.05,onInit:function(){},onProgress:function(){},onComplete:function(){},percentageDisplay:function(n){return n.toFixed(0)}};n.fn.cprogress=function(t){var i=new n.ns.cprogress(this,t);return i.public_methods}})(jQuery);