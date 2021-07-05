View("PaytableView",{STATE_SHOWN:0,STATE_HIDDEN:1,STATE_SHOWING:2,STATE_HIDING:3,STATE_SLIDE_SHOWING:4,STATE_SLIDE_HIDING:5,PAYTABLE_CLOSE_BUTTON_CLICK:"paytableCloseButtonClick",SETTINGS_BUTTON_CLICK:"settingsButtonClick",PAYTABLE_SHOWN:"paytableShown",PAYTABLE_HIDDEN:"paytableHidden"},function(){function d(){this.dispatchEvent(new Event(PaytableView.PAYTABLE_CLOSE_BUTTON_CLICK))}function e(){this.dispatchEvent(new Event(PaytableView.SETTINGS_BUTTON_CLICK))}return{init:function(a){function c(){if(b._window.height()>
b._window.width()){b._paytableCloseButton.visible(!1);b._settingsButton.visible(!1);var a=(b._window.height()-$("#Game").position().top)/Device.scale;b.setSize(1/b._config.scaleCoef*1280,a+4*b._config.paddingY);b._scrollView.setSize(1280,a+b._config.paddingY)}else b._paytableCloseButton.visible(!0),b._settingsButton.visible(!0),b.setSize(1/b._config.scaleCoef*1280,720),b._scrollView.setSize(1280,720-2*b._config.paddingY)}this._config=a;this._showHideTween=this._settingsButton=this._paytableCloseButton=
this._loadingIcon=null;this._state=PaytableView.STATE_HIDDEN;this._position={x:-1280};this._arrowBlinkTween=this._paytableButtonContainerDiv=null;this._super("paytableView",0,0,!0);this.setSize(1/a.scaleCoef*1280,720);this._scrollView=new ScrollView("paytableScrollView",a.paddingX,a.paddingY,!0);this._scrollView.setSize(1280,720-2*a.paddingY);this._scrollView.setScale(1/a.scaleCoef,1/a.scaleCoef);this._loadingIcon=new View("paytableLoading");this._paytableCloseButton=new SettingsPaytableCloseButton(0,
100,{x:0,y:-20,width:100,height:94});this._settingsButton=new Button("settingsFromPaytableButton",0,516,{x:0,y:-20,width:100,height:94},!0);this._settingsButton.addChild(new View("settingsFromPaytableButtonWheelIcon",9,6));this.addChildren(this._scrollView,this._loadingIcon,this._paytableCloseButton,this._settingsButton);this.setPosition(this._position.x,0);this.setZIndex(122);this._paytableCloseButton.addEventListener(MouseEvent.CLICK,d,this);this._settingsButton.addEventListener(MouseEvent.CLICK,
e,this);this._window=$(window);var b=this;setTimeout(c,0);this._window.on("resize",c)},setContent:function(a,c,b,d,f,g,h,k,l,m,n,p){a?(this.removeChild(this._loadingIcon),a=new View("",0,0,!0,$(a)),this._scrollView.addChild(a),setPaytableContent(c,b,d,f,g,h,k,l,m,n,p)):e.call(this)},show:function(){if(this._state!=PaytableView.STATE_SHOWN&&this._state!=PaytableView.STATE_SHOWING)if(this._state=PaytableView.STATE_SHOWING,this._state==PaytableView.STATE_HIDING)this._showHideTween.updateTo({x:0});else{var a=
this;this._showHideTween=TweenMax.to(this._position,0.2,{x:-this._config.paddingX,ease:Linear.easeNone,onComplete:function(){a._state=PaytableView.STATE_SHOWN;a._showHideTween=null;a.setZIndex(112);a.dispatchEvent(new Event(PaytableView.PAYTABLE_SHOWN))},onUpdate:function(){a.setPosition(a._position.x,a.y())}})}},hide:function(){if(this._state!=PaytableView.STATE_HIDDEN&&this._state!=PaytableView.STATE_HIDING)if(this._state=PaytableView.STATE_HIDING,this._state==PaytableView.STATE_SHOWING)this._showHideTween.updateTo({x:-1350});
else{var a=this;this._showHideTween=TweenMax.to(this._position,0.3,{x:-1350,ease:Linear.easeNone,onComplete:function(){a._state=PaytableView.STATE_HIDDEN;a._showHideTween=null;a.dispatchEvent(new Event(PaytableView.PAYTABLE_HIDDEN))},onUpdate:function(){a.setPosition(a._position.x,a.y())}})}},dispose:function(){console.log("DISPOSE");this._paytableCloseButton.dispose();this._scrollView.dispose();this._super()}}}());
