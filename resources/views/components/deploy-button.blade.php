<form method="POST" action="{{ cp_route('vercel-statamic.deployments.redeploy', ['id' => $id]) }}">
    @csrf
    <button type="submit" class="btn-primary">{{ $label }}</a>
</form>
