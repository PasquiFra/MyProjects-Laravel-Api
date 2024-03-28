@if (Route::is('admin.products.show'))

<script>

    const deleteForm = document.getElementById('form-delete');

    deleteForm.addEventListener('submit', e => {
        e.preventDefault();

        const confirmation = confirm('Sei sicuro di voler eliminare {{$project['title']}}?');
        if(confirmation) deleteForm.submit();
    });

</script>

@elseif (Route::is('admin.products.index'))

<script>

    const deleteForm = document.querySelectorAll('.form-delete');

    deleteForm.forEach(form => {
        form.addEventListener('submit', e => {
        e.preventDefault();

        const confirmation = confirm('Sei sicuro di voler eliminare {{$project['title']}}?');
        if(confirmation) deleteForm.submit();
        });
    })
    
    

</script>

@endif
