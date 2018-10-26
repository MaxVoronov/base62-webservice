<?php declare(strict_types=1);

namespace App\Controller;

use Amirax\Base62Interface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class EncodeController
{
    protected $request;
    protected $serializer;

    public function __construct(Request $request, Base62Interface $serializer)
    {
        $this->request = $request;
        $this->serializer = $serializer;
    }

    public function execute(): JsonResponse
    {
        $sourceData = $this->request->query->get('data');

        return new JsonResponse([
            'source' => $sourceData,
            'result' => $this->serializer->encode($sourceData)
        ]);
    }
}
