@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Publisher</th>
                            <th>Total Pages</th>
                            <th>Authors</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ isset($book->volumeInfo->title) ? $book->volumeInfo->title : 'N/A' }}</td>
                                <td>{{ isset($book->volumeInfo->subtitle) ? $book->volumeInfo->subtitle : 'N/A' }}</td>
                                <td>{{ isset($book->volumeInfo->publisher) ? $book->volumeInfo->publisher : 'N/A' }}</td>
                                <td>{{ isset($book->volumeInfo->pageCount) ? $book->volumeInfo->pageCount : 'N/A' }}</td>
                                <td>{{ isset($book->volumeInfo->authors) ? implode(",",$book->volumeInfo->authors) : 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
@endsection
