Barba.Pjax.start();
var shutterA = document.querySelector('.shutter-a');
var shutterB = document.querySelector('.shutter-b');

var ShutterAnimation = Barba.BaseTransition.extend({

  // Barba.jsで定義されている。コンストラクタと考えてよいそうです。
  start: function() {
    this.shutter(400)
      .then(this.newContainerLoading)
      .then(this.finish.bind(this));
  },

  // シャッターが閉まるようなアニメーションをさせる処理
  shutter: function(timer) {
    return new Promise( function (resolve) {
      // クラスを付け替え、移動させる
      shutterA.classList.toggle('moved');
      shutterB.classList.toggle('moved');

      // 埋まるまで（400ms）待つ
      setTimeout(function () {
        resolve();
      }, timer);

    });
  },

  // アニメーションの終了を示すためにthis.done()を呼ぶことが必須
  finish: function() {
    document.body.scrollTop = 0;
    this.done();
  }

});

Barba.Pjax.getTransition = function() {
  return ShutterAnimation;
};