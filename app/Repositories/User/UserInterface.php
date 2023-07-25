<?php

namespace App\Repositories\User;

interface UserInterface
{
    /**
     * INSERT DATA
     * @param array $data
     * @return object
     */
    public function create($data);

    /**
     * GET DATA
     * @param object $request
     * @param array $condition
     * @return object
     */
    public function getRequest($request, $conditions = []);
    public function get($conditions = false);

    /**
     * FIND DATA
     * @param mixed $keyword : id, name
     * @param string $value
     * @return object
     */
    public function find($keyword, $value);

    /**
     * UPDATE DATA
     * @param mixed $id
     * @param array $data
     * @return object
     */
    public function update($id, $data);

    /**
     * DELETE DATA
     * @param mixed $id
     * @return object
     */
    public function destroy($id);
    public function destroyForce($id);

    /**
     * RESTORE TRASH
     * @param mixed $id
     * @return object
     */
    public function restore($id);

    /**
     * CHECK DATA IS EXIST OR NO
     * @param array $param
     * @return object
     */
    public function firstOrNew($param);

    /**
     * UPDATE OR CREATE DATA
     * @param array $param
     * @return object
     */
    public function updateOrCreate($param, $field);
}
