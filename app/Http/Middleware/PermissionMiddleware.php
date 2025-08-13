<?php
    namespace App\Http\Middleware;

    use App\Enums\PermissionEnum;
    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Auth\Access\AuthorizationException;
    use Symfony\Component\HttpFoundation\Response;

    class PermissionMiddleware
    {
        public function handle(Request $request, Closure $next, ...$permissions): Response
        {
            $permissions = array_map(fn ($perm) => $perm instanceof PermissionEnum ? $perm->value : $perm, $permissions);

            // Split pipe-separated permissions into an array
            $permissionList = [];
            foreach ($permissions as $perm) {
                $permissionList = array_merge($permissionList, explode('|', $perm));
            }

            if (!auth()->user() || !auth()->user()->hasAnyPermission($permissionList)) {
                throw new AuthorizationException('Unauthorized', 403);
            }

            return $next($request);
        }
    }
