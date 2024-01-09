@php
use App\Models\User;
$users=User::all()
@endphp
<style>
        .tg{
            border-collapse:collapse;
            border-spacing:0;
            color: white;
            width: 100%;
        }
        .tg td{
            border-color:transparent;
            border-style:solid;
            border-width:1px;
            font-family:Arial, sans-serif;
            font-size:14px;
            overflow:hidden;
            padding:10px 5px;
            word-break:normal;
        }
        .tg th{
            border-color:transparent;
            border-style:solid;
            border-width:1px;
            font-family:Arial, sans-serif;
            font-size:14px;
            font-weight:normal;
            overflow:hidden;
            padding:10px 5px;
            word-break:normal;
        }
        .tg .tg-0lax{
            text-align: center;
            vertical-align: top;
            font-size: 19px;
            cursor: pointer;
        }
        .tg .tg-0lax:hover{
            background-color: #1f1f1f;
        }
        .tg tbody tr{
            height: 50px;
        }
        .tg tbody td{
            font-size: 18px;
        }
        .tg svg{

        height: 20px;
        width: 20px;
        }
        .del{
        fill: #cc0000;
        }

        .tg td button{
        background-color: transparent;
        border: none;
        cursor: pointer;
        }
        

</style>

<x-dashboard>
<x-slot name="content">

<table class="tg">
                            <thead style="font-weight: bold;border-bottom: solid;">
                                <tr>
                                    <td class="tg-0lax">Id<br></td>
                                    <td class="tg-0lax">Username<br></td>
                                    <td class="tg-0lax">Email<br></td>
                                    <td class="tg-0lax">Actions<br></td>    
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="tg-0lax">{{$user['id']}}<br></td>
                                            <td class="tg-0lax">{{$user['name']}}<br></td>
                                            <td class="tg-0lax">{{$user['email']}}<br></td>
                                            

                                            @if(auth()->user()?->can('admin') || $tourn['organizer_id'] == auth()->user()?->id)
                                            <td class="tg-0lax">
                                             <form method="post" action="../api/user/{{$user['id']}}/delete">
                                                @csrf   
                                                @method('DELETE')
                                                <button >
                                                    <svg class="del" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                                </button> 
                                                
                                               <!-- <button > 
                                                <svg class="edt" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><!-- <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                </button> -->
                                             </form>
                                            </td>   
                                            @endif

                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>


</x-slot>
</x-dashboard>