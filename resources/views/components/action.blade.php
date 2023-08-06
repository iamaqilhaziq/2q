@if (empty($no_action))

<a role="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ __('labels.action') }}
</a>
<div class="dropdown-menu dropdown-menu-right">

    {{-- update button --}}
    @isset($update)
    @can($update['permission'] ?? null)
    <a role="button" href="{{ $update['route'] ?? '#' }}" class="dropdown-item" @isset($update['attribute']) {!! $update['attribute'] !!} @endisset>
        <i class="fa fa-edit mr-2 text-purple"></i>
        {{ __('labels.edit') }}
    </a>
    @endcan
    @endisset

    {{-- delete button --}}
    @isset($delete)
    @can($delete['permission'] ?? null)
    <form action="{{ $delete['route'] }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="dropdown-item delete-button">
            <i class="fa fa-trash mr-2 text-red"></i>
            Delete
        </button>
    </form>
    @endcan
    @endisset

</div>

<script>
    // Add this script at the end of your view or in a separate JS file

    // Get all delete buttons with the "delete-button" class
    const deleteButtons = document.querySelectorAll('.delete-button');

    // Add a click event listener to each delete button
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const form = this.closest('form');

            // Show the confirmation dialog using SweetAlert2 library
            Swal.fire({
                title: '',
                text: "Are you sure to delete?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    form.submit();
                }
            });
        });
    });
</script>

@endif