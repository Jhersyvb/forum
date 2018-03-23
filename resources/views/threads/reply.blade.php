<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="card my-3">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a href="{{ route('profile', $reply->owner->name) }}">
                        {{ $reply->owner->name }}
                    </a> said {{ $reply->created_at->diffForHumans() }}...
                </div>

                <div class="col-auto">
                    <favorite :reply="{{ $reply }}"></favorite>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea name="" id="" class="form-control" v-model="body"></textarea>
                </div>

                <button class="btn btn-sm btn-primary" @click="update">Update</button>
                <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
            </div>

            <div v-else v-text="body"></div>
        </div>

        @can('update', $reply)
            <div class="card-footer">
                <div class="row">
                    <div class="col-auto">
                        <button class="btn btn-sm" @click="editing = true">Edit</button>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-sm btn-danger" @click="destroy">Delete</button>
                    </div>
                </div>
            </div>
        @endcan
    </div>
</reply>