@extends("blogetc_admin::layouts.admin_layout")
@section("content")
    <div class="alert alert-success">
        <b>Deleted that post</b>
        <br/>
        <a href="{{ route('admin.blogetc.admin.index') }}" class="btn btn-primary">
            Back to posts overview
        </a>
    </div>

    <?php
    $images_to_delete = [];
    foreach ((array)config('blogetc.image_sizes') as $image_size => $image_size_info) {
        if (!$deletedPost->$image_size) {
            continue;
        }
        $images_to_delete[] = $image_size;
    }?>

    @if(count($images_to_delete))
        <p>However, the following images were <strong>not</strong> deleted:</p>

        <table class="table">
            <thead>
            <tr>
                <th>Image/link</th>
                <th>Filename / filesize</th>
                <th>Full location</th>
            </tr>
            </thead>
            <tbody>
            @foreach($images_to_delete as $image_size)
                <tr>
                    <td class="text-center">
                        <a href="{{asset(config("blogetc.blog_upload_dir","blog_images")."/".$deletedPost->$image_size) }}"
                           target="_blank" class="btn btn-primary m-1">
                            view
                        </a>

                        <img alt="Uploaded image" src="{{asset(config("blogetc.blog_upload_dir","blog_images")."/".$deletedPost->$image_size) }}"
                             width="100" />

                    </td>
                    <td><code>{{$deletedPost->$image_size}}</code>
                        {{--check filesize returns something, so we don't divide by 0--}}
                        @if(filesize(public_path(config("blogetc.blog_upload_dir","blog_images")."/".$deletedPost->$image_size)))
                            ({{ (round(filesize(public_path(config("blogetc.blog_upload_dir","blog_images")."/".$deletedPost->$image_size)) / 1000 ,1)). " kb"}})
                        @endif
                    </td>
                    <td><code>
                            <small>{{ public_path(config("blogetc.blog_upload_dir","blog_images")."/".$deletedPost->$image_size) }}</small>
                        </code></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p>
            Please manually remove those files from the filesystem if desired.
        </p>
    @endif
@endsection

