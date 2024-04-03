<script>
    
    function getSlugTitle(){
        const titleForm = document.getElementById('title').value;
        
        const splitTitle = titleForm.toLowerCase().split(' ');
        
        const slugTitle = splitTitle.join('-');
        
        return slugTitle
    }
    
    document.getElementById('title').addEventListener('change', function() {
        
        document.getElementById('slug').value = getSlugTitle();
    });

    document.getElementById('title').addEventListener('submit', function() {
        
        document.getElementById('slug').value = getSlugTitle();
    });

</script>