function StateWaitingForSpinResult(b,c){this.spin=function(){throw'Invalid command "spin" in StateWaitingForSpinResult!';};this.gamble=function(){throw'Invalid command "gamble" in StateWaitingForSpinResult!';};this.jackpot=function(){throw'Invalid command "jackpot" in StateWaitingForSpinResult!';};this.collect=function(){throw'Invalid command "collect" in StateWaitingForSpinResult!';};this.setResult=function(){throw'Invalid command "setResult" in StateWaitingForSpinResult!';};this.onResult=function(){var a=
GameSettings.getInstance();if(a.serverMessage.type==BaseMessage.SPIN)c(StateMachineContext.STATE_WIN),b.spinReceived();else if(a.serverMessage.type==BaseMessage.COLLECT)c(StateMachineContext.STATE_IDLE),b.setTerminalInsufficientBalanceVisualState();else throw"Invalid message type "+a.serverMessage.type+" in StateWaitingForSpinResult!";};this.getState=function(){return StateMachineContext.STATE_WAITING_FOR_SPIN_RESULT}};
