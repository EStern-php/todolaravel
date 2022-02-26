<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Your todo lists') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <button class="btn btn-success btn-small create-new-btn">Create new todolist</button>
        </div>
        <div class="row">
            @foreach( $userslists as $list)
                <div class="col-3 m-5 p-2 bg-secondary text-white">
                    <button type="button" class="delete-list-btn btn" data-id="{{$list->id}}" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="text-center">{{$list->name}}</h2>
                    <ul class="list-group">
                    @foreach($list->tasks as $task)
                      @if($task->completed == 1)
                      <li class="list-group-item text-secondary"><button type="button" data-id="{{$task->id}}" class="btn btn-danger btn-xs remove-task-btn" aria-label="Close"><i class="fa fa-close"></i></button> <span class="task-{{$task->id}} text-decoration-line-through"> {{$task->task_desc}} </span><button class="complete-btn btn float-right btn-success" data-completed="0" data-id="{{$task->id}}"><i class="fa fa-check"></i></button></li>
                      @else
                      <li class="list-group-item text-secondary"><span class="task-{{$task->id}}"> {{$task->task_desc}} </span> <button class="complete-btn btn float-right" data-completed="1" data-id="{{$task->id}}"><i class="fa fa-check"></i></button></li>
                      @endif
                    @endforeach
                    <li class="list-group-item text-secondary text-center"><button class="add-task-btn btn" data-id="{{$list->id}}">Add new task <i class="fa fa-plus"></i></button></li>
                    </ul>
                </div>
            @endforeach
        </div>

    </div>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>





<div class="modal new-list-modal" id="new-list-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Todo List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="new-list-form">
      <div class="modal-body">
        
            <label for="listname">List name:</label><br>
            <input type="text" id="listname" name="listname"><br>
            
        
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal edit-list-modal" id="edit-list-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Todo List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="edit-list-form">
      <div class="modal-body">
            <input type="hidden" id="list-id" name="list-id">
            <label for="task">Task description:</label>
            <textarea id="task" name="task"></textarea>
            
        
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal delete-list-modal" id="delete-list-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Todo List?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="delete-list-form">
      <div class="modal-body">
            <input type="hidden" name="list-id" id="list-id">
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>