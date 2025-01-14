<?php

/**
 * @file controllers/grid/files/submission/AuthorSubmissionDetailsFilesGridHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class AuthorSubmissionDetailsFilesGridHandler
 * @ingroup controllers_grid_files_submission
 *
 * @brief Handle submission file grid requests on the author's submission details pages.
 */

use PKP\controllers\grid\files\FilesGridCapabilities;
use PKP\security\Role;
use PKP\submissionFile\SubmissionFile;

// Import the grid layout.
import('lib.pkp.controllers.grid.files.fileList.FileListGridHandler');
import('lib.pkp.controllers.grid.files.SubmissionFilesGridDataProvider');

class AuthorSubmissionDetailsFilesGridHandler extends FileListGridHandler
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $dataProvider = new SubmissionFilesGridDataProvider(SubmissionFile::SUBMISSION_FILE_SUBMISSION);
        parent::__construct($dataProvider, WORKFLOW_STAGE_ID_SUBMISSION, FilesGridCapabilities::FILE_GRID_DOWNLOAD_ALL | FilesGridCapabilities::FILE_GRID_EDIT);

        $this->addRoleAssignment(
            [Role::ROLE_ID_MANAGER, Role::ROLE_ID_SUB_EDITOR, Role::ROLE_ID_ASSISTANT, Role::ROLE_ID_AUTHOR],
            ['fetchGrid', 'fetchRow']
        );

        // Grid title.
        $this->setTitle('submission.submit.submissionFiles');
    }
}
