<?php

namespace App\Controller;

use App\Entity\ClassRoom;
use App\Doctrine as UOW;
use App\Query\ClassRoomListQuery;
use App\RequestObject\RequestCreateClassRoom;
use App\RequestObject\RequestUpdateClassRoomActive;
use Nelmio\ApiDocBundle\Annotation\Model;
use Ramsey\Uuid\Uuid;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/classrooms", requirements={"_format"="json"}, defaults={"_format": "json"})
 */
class ClassRoomController extends AbstractController
{
    /**
     * List of ClassRooms
     *
     * @SWG\Tag(name="ClassRoom")
     * @SWG\Response(
     *     response=200,
     *     description="Returns list of ClassRooms",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=ClassRoom::class))
     *     )
     * )
     *
     * @Route(
     *     ".{_format}",
     *     methods={"GET"},
     * )
     */
    public function list(ClassRoomListQuery $query)
    {
        $entities = $query();

        return $this->json($entities);
    }

    /**
     * View ClassRoom by id
     *
     * @SWG\Tag(name="ClassRoom")
     * @SWG\Response(
     *     response=200,
     *     description="Returns one ClassRoom",
     *     @Model(type=ClassRoom::class)
     * )
     *
     * @Route(
     *     "/{id}.{_format}",
     *     requirements={"id": "^[a-f0-9]{8}-([a-f0-9]{4}-){3}[a-f0-9]{12}$"},
     *     methods={"GET"},
     * )
     */
    public function view(ClassRoom $classRoom)
    {
        return $this->json($classRoom);
    }

    /**
     * Enable/Disable ClassRoom by id
     *
     * @SWG\Tag(name="ClassRoom")
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     @Model(type=RequestUpdateClassRoomActive::class)
     * )
     * @SWG\Response(
     *     response="204",
     *     description="Returned when successful",
     * )
     * @Route(
     *     "/{id}.{_format}",
     *     requirements={"id": "^[a-f0-9]{8}-([a-f0-9]{4}-){3}[a-f0-9]{12}$"},
     *     methods={"PATCH"},
     * )
     */
    public function update(ClassRoom $classRoom, RequestUpdateClassRoomActive $request, UOW\Commit $commit)
    {
        $request->isActive ? $classRoom->enable() : $classRoom->disable();
        $commit();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Create ClassRoom
     *
     * @SWG\Tag(name="ClassRoom")
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     @Model(type=RequestCreateClassRoom::class)
     * )
     * @SWG\Response(
     *     response="201",
     *     description="Returned when successful",
     *     @SWG\Schema(
     *         type="object",
     *         example={"id": "00000000-0000-0000-0000-000000000000"},
     *     )
     * )
     *
     * @Route(
     *     ".{_format}",
     *     methods={"POST"},
     * )
     */
    public function create(RequestCreateClassRoom $request, UOW\Commit $commit, UOW\Persist $persist)
    {
        $id = Uuid::uuid4();

        $persist(ClassRoom::create($request->name, $id));
        $commit();

        return $this->json([
            'id' => $id,
        ], Response::HTTP_CREATED);
    }

    /**
     * Delete ClassRoom by id
     *
     * @SWG\Tag(name="ClassRoom")
     * @SWG\Response(
     *     response="204",
     *     description="Returned when successful",
     * )
     *
     * @Route(
     *     "/{id}.{_format}",
     *     requirements={"id": "^[a-f0-9]{8}-([a-f0-9]{4}-){3}[a-f0-9]{12}$"},
     *     methods={"DELETE"},
     * )
     */
    public function delete(ClassRoom $classRoom, UOW\Remove $remove, UOW\Commit $commit)
    {
        $remove($classRoom);

        $commit();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
