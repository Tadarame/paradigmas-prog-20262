<?php

namespace App\Http\Services;

use App\Http\Repositories\ClassroomRepository;

class ClassroomService extends BaseService
{
    public function __construct(private ClassroomRepository $classroomRepository)
    {
        parent::__construct($classroomRepository);
    }

    public function getWithFilters(array $data)
    {
        return $this->classroomRepository->getWithFilters($data);
    }
    public function manageUser(string $classroomId, array $data): array
    {
        if ($data['action'] === 'add') {
            $this->classroomRepository->addUser(
                $classroomId,
                (string) $data['user_id']
            );

            return ['message' => 'Usuário adicionado à turma.'];
        }

        $this->classroomRepository->removeUser(
            $classroomId,
            (string) $data['user_id']
        );

        return ['message' => 'Usuário removido da turma.'];
    }
}
