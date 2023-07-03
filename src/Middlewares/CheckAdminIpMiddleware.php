<?php

namespace AdminKit\Core\Middlewares;

use Closure;

class CheckAdminIpMiddleware
{
    /**
     * Ловим входящий запрос.
     * Проверяет IP адрес в белом списке.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $whiteIps = config('project.adminWhiteIps.list');
        $whiteIpsToken = config('project.adminWhiteIps.token');
        $whiteListEnable = config('project.adminWhiteIps.white_list_enable');
        $whiteListAccessByTokenEnable = config('project.adminWhiteIps.white_list_access_by_token_enable');

        $requestToken = $request->get('token');

        // Проверяем токен, если есть в запросе и он валидный, даем доступ к админке.
        if ($whiteListAccessByTokenEnable && $whiteIpsToken == $requestToken) {
            return $next($request);
        }

        // Проверяем IP адрес, если он не в белом списке, то не даем доступ к админке.
        if ($whiteListEnable && !in_array($request->ip(), $this->getFilteredIps($whiteIps))) {
            return response()->json(['error' => 403, 'message' => 'Access denied!'], 403);
        }

        return $next($request);
    }

    /**
     * Фильтрует все IP адреса в один список
     * Находит все IP адреса в subnet.
     */
    private function getFilteredIps(array $whiteIps)
    {
        $filteredWhiteIps = [];

        foreach($whiteIps as $ip => $ipData) {
            if(isset($ipData['ip']) && isset($ipData['subnet'])) {
                $subnet = new \IPv4\SubnetCalculator($ipData['ip'], $ipData['subnet']);

                foreach ($subnet->getAllIPAddresses() as $ip_address) {
                    array_push($filteredWhiteIps, $ip_address);
                }
            } elseif(isset($ipData['ip'])) {
                array_push($filteredWhiteIps, $ipData['ip']);
            }
        }

        return $filteredWhiteIps;
    }
}
