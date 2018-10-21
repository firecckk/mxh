### 两种登陆方式：

1. 新用户/Session过期用户：
    > **request** - [GET] http://mxh.ddns.net/api/wx/login.php?type=code&code=USER_CODE&encrypteddata=ENCRYPTEDDATA$&iv=IV
    > - #USER_CODE : 从wx.login获取的用户code 
    > - #ENCRYPTEDDATA : 获取到的encrypteddata
    > - #IV : 获取到的解密初始向量

    > **response**
    > - 新用户 : 
        {userType:"new";Session:"SESSION";} #返回状态码和新Session，并将Session保存
    > - 老用户 :
        {userType:"old";Session:"SESSION";}
    > - code 无效时: 
        {"errcode": 40029,"errmsg": "invalid code"}

2. 正常登陆：
    > **request** - [GET] http://mxh.ddns.net/api/wx/login.php?type=session&session=USER_SESSION 
    > - #USER_SESSION : 从本地storage里面读取的Session 

    > **response** 
    > - {status:"expired session";} #Session过期，需要重新登入。
    > - {status:"invalid session";} #非法Session。如果遇到这个，报错给我
    > - {status:"ok";} #验证成功

