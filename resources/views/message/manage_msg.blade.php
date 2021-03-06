@extends('layouts.app')

@section('title','用户列表')

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            {{--            <li><a href="{{url('/blacklist')}}">用户管理</a></li>--}}
        </ul>
        <div class="row">
            <div class="col-xs-6 col-md-2"></div>
            <div class="col-xs-6 col-md-8">
                <h3><span><a href="{{url('/user_manage')}}">用户列表</a></span><span style="margin-left: 10px;"><a href="{{url('/blacklist')}}" >黑名单管理</a></span><span style="margin-left: 10px;">留言管理</span></h3>
                <table class="table table-hover table-striped">
                    <tr>
                        <td>#</td>
                        <td>文章标题</td>
                        <td>留言内容</td>
                        <td>留言时间</td>
                        <td>留言者</td>
                        <td>操作</td>
                    </tr>
                    @foreach($list as $k => $v)
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>{{$v->articel->title}}</td>
                            <td>{{$v->content}}</td>
                            <td>{{$v->ctime}}</td>
                            <td>{{$v->user->username}}</td>
                            <td>
                                @if( empty($v->blacklist))
                                    <button class="btn btn-danger" onclick="set_black({{$v->user_id}})" > 拉黑 </button>
                                @else
                                    <span>已拉黑</span>
                                @endif

                                @if( $v->is_del == 1)
                                    已删除
                                @else
                                    <span ><button class="btn btn-warning" onclick="del_comment({{$v->id}})">删除</button></span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $list->render() }}

            </div>
            <div class="col-xs-6 col-md-2"></div>
        </div>
    </div>
@endsection

<script>
    function set_black(user_id){
        $.ajax({
            type:'GET',
            dataType:'json',
            url:"{{url('/set_black')}}/" + user_id,
            success : function (ret) {
                if(ret.code == 0){
                    alert('操作成功')
                    window.location.reload();
                }else{
                    alert(ret.msg);
                }
            },
            error : function() {
                alert('服务器异常');
            }
        })
    }

    function del_comment(id){
        $.ajax({
            type:'GET',
            dataType:'json',
            url:"{{url('/message/del')}}/" + id,
            success : function (ret) {
                if(ret.code == 0){
                    alert('操作成功')
                    window.location.reload();
                }else{
                    alert(ret.msg);
                }
            },
            error : function() {
                alert('服务器异常');
            }
        })
    }

</script>
