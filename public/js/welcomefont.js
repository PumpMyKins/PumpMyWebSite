var livePatern = {
  canvas: null,
  context: null,
  cols: 0,
  rows: 0,
  colors: [230, 229, 227, 225, 219, 215],
  triangleColors: [],
  destColors: [],
  
  resizeCanval: function(){
                         
    var me = this;

    if(me.width != document.body.clientWidth || me.height != document.body.clientHeight) {
      
      livePatern.init();
    }
  },
  
  init: function(){

    var body = document.body,
    html = document.documentElement;
    var height = Math.max(body.scrollHeight, body.offsetHeight, 
                          html.clientHeight, html.scrollHeight, html.offsetHeight );
    var width = Math.max(body.scrollWidth, body.offsetWidth,
                         html.clientWidth, html.scrollWidth, html.offsetWidth);

    this.canvas = document.getElementById('canvas');
    this.context = this.canvas.getContext('2d');
    this.cols = Math.floor(document.body.clientWidth / 21);
    this.rows = Math.floor(height / 21) + 1;
    
    this.canvas.width = width;
    this.canvas.height = height;
    this.drawBackground();
    this.animate();
  },

  drawTriangle: function(x, y, color, inverted){
    inverted = inverted == undefined ? false : inverted;

    this.context.beginPath();
    this.context.moveTo(x, y);
    this.context.lineTo(inverted ? x - 22 : x + 22, y + 11);
    this.context.lineTo(x, y + 22);
    this.context.fillStyle = "rgb("+color+","+color+","+color+")";
    this.context.fill();
    this.context.closePath();
  },
  
  getColor: function(){    
    return this.colors[(Math.floor(Math.random() * 6))];
  },
  
  drawBackground: function(){
    var eq = null;
    var x = this.cols;
    var destY = 0;
    var color, y;
    
    while(x--){
      eq = x % 2;
      y = this.rows;

      while(y--){
        destY = Math.round((y-0.5) * 24);

        this.drawTriangle(x * 24 + 2, eq == 1 ? destY : y * 24, this.getColor());
        this.drawTriangle(x * 24, eq == 1 ? destY  : y * 24, this.getColor(), true);
      }
    }
  },
  animate: function(){
    var me = this;

    var x = Math.floor(Math.random() * this.cols);
    var y = Math.floor(Math.random() * this.rows);
    var eq = x % 2;

    if (eq == 1) {
      me.drawTriangle(x * 24, Math.round((y-0.5) * 24) , this.getColor(), true);
    } else {
      me.drawTriangle(x * 24 + 2, y * 24, this.getColor());
    }

    setTimeout(function(){    
      me.animate.call(me);
    }, 10);
    
    window.addEventListener('resize', this.resizeCanval, true);

  },
};

!function(){livePatern.init();}()