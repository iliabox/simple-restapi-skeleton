<?php

namespace App\ValueResolver;

use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\Request;
use App\RequestObject\RequestObjectInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestObjectValueResolver implements ArgumentValueResolverInterface
{
    /**
     * @var DenormalizerInterface
     */
    private $denormalizer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * RequestObjectValueResolver constructor.
     * @param DenormalizerInterface $denormalizer
     * @param ValidatorInterface $validator
     */
    public function __construct(DenormalizerInterface $denormalizer, ValidatorInterface $validator)
    {
        $this->denormalizer = $denormalizer;
        $this->validator = $validator;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $classname = $argument->getType();

        $data = json_decode($request->getContent(), true);

        if ($jsonError = json_last_error()) {
            throw new BadRequestHttpException($jsonError);
        }

        if (!is_array($data)) {
            throw new BadRequestHttpException();
        }

        $object =  $this->denormalizer->denormalize($data, $classname, null, ['allow_extra_attributes' => false]);

        $errors = $this->validator->validate($object);
        if (count($errors) > 0) {
            $errorsString = (string)$errors;
            throw new BadRequestHttpException($errorsString);
        }

        yield $object;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return is_subclass_of($argument->getType(), RequestObjectInterface::class);
    }
}
