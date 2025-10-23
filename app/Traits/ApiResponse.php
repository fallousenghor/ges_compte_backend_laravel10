<?php

namespace App\Traits;

use App\Constants\HttpConstants;
use App\Constants\MessageConstants;

trait ApiResponse
{
    /**
     * Format de base pour les réponses API
     */
    protected function apiResponse($data = null, $message = null, $code = null)
    {
        $statusCode = $code ?? HttpConstants::OK;

        $response = [
            'success' => $statusCode >= HttpConstants::OK && $statusCode < HttpConstants::BAD_REQUEST,
            'message' => $message ?? MessageConstants::OPERATION_SUCCESSFUL,
            'data' => $data
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * Réponse pour une opération réussie
     */
    protected function successResponse($data, $message = null, $code = null)
    {
        return $this->apiResponse(
            $data,
            $message ?? MessageConstants::OPERATION_SUCCESSFUL,
            $code ?? HttpConstants::OK
        );
    }

    /**
     * Réponse pour une création réussie
     */
    protected function createdResponse($data, $message = null, $code = null)
    {
        return $this->apiResponse(
            $data,
            $message ?? MessageConstants::CREATED_SUCCESSFULLY,
            $code ?? HttpConstants::CREATED
        );
    }

    /**
     * Réponse pour une erreur
     */
    protected function errorResponse($message = null, $code = null)
    {
        return $this->apiResponse(
            null,
            $message ?? MessageConstants::ERROR_OCCURRED,
            $code ?? HttpConstants::BAD_REQUEST
        );
    }

    /**
     * Réponse pour une ressource non trouvée
     */
    protected function notFoundResponse($message = null)
    {
        return $this->apiResponse(
            null,
            $message ?? MessageConstants::NOT_FOUND,
            HttpConstants::NOT_FOUND
        );
    }

    /**
     * Réponse pour une validation échouée
     */
    protected function validationErrorResponse($errors, $message = null)
    {
        return $this->apiResponse(
            $errors,
            $message ?? MessageConstants::VALIDATION_ERROR,
            HttpConstants::UNPROCESSABLE_ENTITY
        );
    }

    /**
     * Réponse pour une action non autorisée
     */
    protected function unauthorizedResponse($message = null)
    {
        return $this->apiResponse(
            null,
            $message ?? MessageConstants::UNAUTHORIZED,
            HttpConstants::UNAUTHORIZED
        );
    }

    /**
     * Réponse pour une suppression réussie
     */
    protected function deletedResponse($message = null)
    {
        return $this->apiResponse(
            null,
            $message ?? MessageConstants::DELETED_SUCCESSFULLY,
            HttpConstants::OK
        );
    }

    /**
     * Réponse pour une mise à jour réussie
     */
    protected function updatedResponse($data, $message = null)
    {
        return $this->apiResponse(
            $data,
            $message ?? MessageConstants::UPDATED_SUCCESSFULLY,
            HttpConstants::OK
        );
    }

    /**
     * Réponse pour une liste de ressources
     */
    protected function collectionResponse($data, $message = null)
    {
        return $this->apiResponse(
            $data,
            $message ?? MessageConstants::LIST_RETRIEVED_SUCCESSFULLY,
            HttpConstants::OK
        );
    }

    /**
     * Réponse pour une ressource unique
     */
    protected function resourceResponse($data, $message = null)
    {
        return $this->apiResponse(
            $data,
            $message ?? MessageConstants::RETRIEVED_SUCCESSFULLY,
            HttpConstants::OK
        );
    }

    /**
     * Compatibility wrapper used across controllers in this project.
     * Provides the same behaviour as the existing response helpers but
     * with the short names `success` and `error` used in some controllers.
     */
    protected function success($data = null, $message = null, $code = null)
    {
        return $this->successResponse($data, $message, $code);
    }

    protected function error($message = null, $code = null, $errors = null)
    {
        // If errors array/collection is provided, treat it as validation errors
        if (!is_null($errors)) {
            return $this->validationErrorResponse($errors, $message);
        }

        return $this->errorResponse($message, $code);
    }
}
