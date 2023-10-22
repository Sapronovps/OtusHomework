<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Command;

use Sapronovps\OtusHomework\FinalWork\Core\Exception\DocumentException;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CommandInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Iterator\DocumentList;
use Sapronovps\OtusHomework\FinalWork\Core\Service\DocumentSaverService;

/**
 * Команда для массового сохранения документов.
 */
class DocumentSavableCommand implements CommandInterface
{
    public function __construct(
        private readonly DocumentList $documents,
        private readonly DocumentSaverService  $documentSaverService = new DocumentSaverService()
    )
    {
    }

    public function execute(): void
    {
        foreach ($this->documents as $document) {
            $result = $this->documentSaverService->save($document);

            if (null === $result) {
                throw new DocumentException('Не удалось провести документ, смотрите логи.');
            }
        }
    }
}