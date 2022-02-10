<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>welcome-test</title>
</head>

<body>
    <form action="{{ url('/home') }}" method="post">
        <table>
            <tr>
                @csrf
                <label>
                    <input type="text" name="sidimei" value="學號">
                </label>
                <label>
                    <input type="text" name="password" value="密碼">
                </label>

            <tr>
                <td></td>
                <td><input type="submit" value="提交"></td>
                <a href="{{ url('places/create') }}" class="abc" style="margin:0 0 0 38%">新增</a>
            </tr>
            </tr>
        </table>
    </form>

</body>

</html>
