基于Hyperf框架搭建的JWT认证系统

# 注册

>`POST` http://localhost:9501/api/register

## CURL请求
```curl
curl -X POST \
  http://localhost:9501/api/register \
  -F mobile=15958896868 \
  -F password=123456
```

## Success-Response:
```json
{
    "code": 200,
    "msg": "注册成功",
    "data": ""
}
```

## Error-Response:
```json
{
    "code": 500,
    "msg": "该号码已注册",
    "data": ""
}

```
```json
{
    "msg": "字段验证未通过",
    "code": 422,
    "data": {
        "mobile": [
            "手机号必填"
        ],
        "password": [
            "密码必填"
        ]
    }
}
```

# 登录

>`POST` http://localhost:9501/api/login

## CURL请求

```curl
curl -X POST \
  http://localhost:9501/api/login \
  -F mobile=15958896868 \
  -F password=123456
```

## Success-Response:

```json
{
    "code": 200,
    "msg": "success",
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJkZWZhdWx0XzQiLCJpYXQiOjE2MTU3OTc5NjMsIm5iZiI6MTYxNTc5Nzk2MywiZXhwIjoxNjE1ODA1MTYzLCJ1aWQiOjQsIm1vYmlsZSI6IjE1ODU4ODk2MzYzIiwiand0X3NjZW5lIjoiZGVmYXVsdCJ9.Khp1QXCWMzbNdcSg_PsJyfUNY7Y9VT-o2JTsw8GNXlk",
        "exp": 7200
    }
}
```

## Error-Response:

```json
{
    "code": 500,
    "msg": "登录失败",
    "data": ""
}
```

# 获取用户信息

>`GET` http://localhost:9501/api/info

## CURL请求
```curl
curl -X GET \
  http://127.0.0.1:9501/api/user/info \
  -H 'authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJkZWZhdWx0XzQiLCJpYXQiOjE2MTU3OTc5NjMsIm5iZiI6MTYxNTc5Nzk2MywiZXhwIjoxNjE1ODA1MTYzLCJ1aWQiOjQsIm1vYmlsZSI6IjE1ODU4ODk2MzYzIiwiand0X3NjZW5lIjoiZGVmYXVsdCJ9.Khp1QXCWMzbNdcSg_PsJyfUNY7Y9VT-o2JTsw8GNXlk'
```

## Success-Response:

```json
{
    "code": 200,
    "msg": "success",
    "data": {
        "id": 1,
        "mobile": "15958896868",
        "password": "$2y$10$xkjp3nkGpWApKm9nfXRX8O15ZMTTUSjVjLJEgzzKW0JCsLeKnDmr2",
        "name": "kwin",
        "created_at": "2021-03-15 08:33:00",
        "updated_at": "2021-03-15 08:36:38"
    }
}
```

## Error-Response:

```json
{
    "code": 401,
    "msg": "对不起，token验证没有通过",
    "data": ""
}
```

# 编辑用户名

>`PUT` http://localhost:9501/api/edit_name

## CURL请求
```curl
curl -X PUT \
  http://127.0.0.1:9501/api/user/edit_name \
  -H 'authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJkZWZhdWx0XzQiLCJpYXQiOjE2MTU3OTc5NjMsIm5iZiI6MTYxNTc5Nzk2MywiZXhwIjoxNjE1ODA1MTYzLCJ1aWQiOjQsIm1vYmlsZSI6IjE1ODU4ODk2MzYzIiwiand0X3NjZW5lIjoiZGVmYXVsdCJ9.Khp1QXCWMzbNdcSg_PsJyfUNY7Y9VT-o2JTsw8GNXlk' \
  -F name=kwin
```

## Success-Response:

```json
{
    "code": 200,
    "msg": "编辑成功",
    "data": ""
}
```

## Error-Response:

```json
{
    "code": 500,
    "msg": "编辑失败",
    "data": ""
}
```
