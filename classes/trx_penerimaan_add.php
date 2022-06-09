<?php
namespace PHPMaker2019\project4;

/**
 * Page class
 */
class trx_penerimaan_add extends trx_penerimaan
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}";

	// Table name
	public $TableName = 'trx_penerimaan';

	// Page object name
	public $PageObjName = "trx_penerimaan_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;
		global $UserTable, $UserTableConn;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (trx_penerimaan)
		if (!isset($GLOBALS["trx_penerimaan"]) || get_class($GLOBALS["trx_penerimaan"]) == PROJECT_NAMESPACE . "trx_penerimaan") {
			$GLOBALS["trx_penerimaan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["trx_penerimaan"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tb_user)
		if (!isset($GLOBALS['tb_user']))
			$GLOBALS['tb_user'] = new tb_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'trx_penerimaan');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

		// User table object (tb_user)
		if (!isset($UserTable)) {
			$UserTable = new tb_user();
			$UserTableConn = Conn($UserTable->Dbid);
		}
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $trx_penerimaan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($trx_penerimaan);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "trx_penerimaanview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['kd_penerimaan'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity) && @$RequestSecurity["username"] <> "") // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("trx_penerimaanlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->kd_penerimaan->setVisibility();
		$this->tgl_penerimaan->setVisibility();
		$this->kd_penerima->setVisibility();
		$this->kd_unit->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->kd_penerima);
		$this->setupLookupOptions($this->kd_unit);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("kd_penerimaan") !== NULL) {
				$this->kd_penerimaan->setQueryStringValue(Get("kd_penerimaan"));
				$this->setKey("kd_penerimaan", $this->kd_penerimaan->CurrentValue); // Set up key
			} else {
				$this->setKey("kd_penerimaan", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Set up detail parameters
		$this->setupDetailParms();

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("trx_penerimaanlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$returnUrl = $this->getDetailUrl();
					else
						$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "trx_penerimaanlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "trx_penerimaanview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->kd_penerimaan->CurrentValue = "0";
		$this->tgl_penerimaan->CurrentValue = NULL;
		$this->tgl_penerimaan->OldValue = $this->tgl_penerimaan->CurrentValue;
		$this->kd_penerima->CurrentValue = NULL;
		$this->kd_penerima->OldValue = $this->kd_penerima->CurrentValue;
		$this->kd_unit->CurrentValue = NULL;
		$this->kd_unit->OldValue = $this->kd_unit->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'kd_penerimaan' first before field var 'x_kd_penerimaan'
		$val = $CurrentForm->hasValue("kd_penerimaan") ? $CurrentForm->getValue("kd_penerimaan") : $CurrentForm->getValue("x_kd_penerimaan");
		if (!$this->kd_penerimaan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kd_penerimaan->Visible = FALSE; // Disable update for API request
			else
				$this->kd_penerimaan->setFormValue($val);
		}

		// Check field name 'tgl_penerimaan' first before field var 'x_tgl_penerimaan'
		$val = $CurrentForm->hasValue("tgl_penerimaan") ? $CurrentForm->getValue("tgl_penerimaan") : $CurrentForm->getValue("x_tgl_penerimaan");
		if (!$this->tgl_penerimaan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_penerimaan->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_penerimaan->setFormValue($val);
			$this->tgl_penerimaan->CurrentValue = UnFormatDateTime($this->tgl_penerimaan->CurrentValue, 5);
		}

		// Check field name 'kd_penerima' first before field var 'x_kd_penerima'
		$val = $CurrentForm->hasValue("kd_penerima") ? $CurrentForm->getValue("kd_penerima") : $CurrentForm->getValue("x_kd_penerima");
		if (!$this->kd_penerima->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kd_penerima->Visible = FALSE; // Disable update for API request
			else
				$this->kd_penerima->setFormValue($val);
		}

		// Check field name 'kd_unit' first before field var 'x_kd_unit'
		$val = $CurrentForm->hasValue("kd_unit") ? $CurrentForm->getValue("kd_unit") : $CurrentForm->getValue("x_kd_unit");
		if (!$this->kd_unit->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kd_unit->Visible = FALSE; // Disable update for API request
			else
				$this->kd_unit->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->kd_penerimaan->CurrentValue = $this->kd_penerimaan->FormValue;
		$this->tgl_penerimaan->CurrentValue = $this->tgl_penerimaan->FormValue;
		$this->tgl_penerimaan->CurrentValue = UnFormatDateTime($this->tgl_penerimaan->CurrentValue, 5);
		$this->kd_penerima->CurrentValue = $this->kd_penerima->FormValue;
		$this->kd_unit->CurrentValue = $this->kd_unit->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->kd_penerimaan->setDbValue($row['kd_penerimaan']);
		$this->tgl_penerimaan->setDbValue($row['tgl_penerimaan']);
		$this->kd_penerima->setDbValue($row['kd_penerima']);
		$this->kd_unit->setDbValue($row['kd_unit']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['kd_penerimaan'] = $this->kd_penerimaan->CurrentValue;
		$row['tgl_penerimaan'] = $this->tgl_penerimaan->CurrentValue;
		$row['kd_penerima'] = $this->kd_penerima->CurrentValue;
		$row['kd_unit'] = $this->kd_unit->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("kd_penerimaan")) <> "")
			$this->kd_penerimaan->CurrentValue = $this->getKey("kd_penerimaan"); // kd_penerimaan
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// kd_penerimaan
		// tgl_penerimaan
		// kd_penerima
		// kd_unit

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// kd_penerimaan
			$this->kd_penerimaan->ViewValue = $this->kd_penerimaan->CurrentValue;
			$this->kd_penerimaan->ViewCustomAttributes = "";

			// tgl_penerimaan
			$this->tgl_penerimaan->ViewValue = $this->tgl_penerimaan->CurrentValue;
			$this->tgl_penerimaan->ViewValue = FormatDateTime($this->tgl_penerimaan->ViewValue, 5);
			$this->tgl_penerimaan->ViewCustomAttributes = "";

			// kd_penerima
			$this->kd_penerima->ViewValue = $this->kd_penerima->CurrentValue;
			$curVal = strval($this->kd_penerima->CurrentValue);
			if ($curVal <> "") {
				$this->kd_penerima->ViewValue = $this->kd_penerima->lookupCacheOption($curVal);
				if ($this->kd_penerima->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kd_penerima`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kd_penerima->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->kd_penerima->ViewValue = $this->kd_penerima->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kd_penerima->ViewValue = $this->kd_penerima->CurrentValue;
					}
				}
			} else {
				$this->kd_penerima->ViewValue = NULL;
			}
			$this->kd_penerima->ViewCustomAttributes = "";

			// kd_unit
			$curVal = strval($this->kd_unit->CurrentValue);
			if ($curVal <> "") {
				$this->kd_unit->ViewValue = $this->kd_unit->lookupCacheOption($curVal);
				if ($this->kd_unit->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kd_unit`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kd_unit->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->kd_unit->ViewValue = $this->kd_unit->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kd_unit->ViewValue = $this->kd_unit->CurrentValue;
					}
				}
			} else {
				$this->kd_unit->ViewValue = NULL;
			}
			$this->kd_unit->ViewCustomAttributes = "";

			// kd_penerimaan
			$this->kd_penerimaan->LinkCustomAttributes = "";
			$this->kd_penerimaan->HrefValue = "";
			$this->kd_penerimaan->TooltipValue = "";

			// tgl_penerimaan
			$this->tgl_penerimaan->LinkCustomAttributes = "";
			$this->tgl_penerimaan->HrefValue = "";
			$this->tgl_penerimaan->TooltipValue = "";

			// kd_penerima
			$this->kd_penerima->LinkCustomAttributes = "";
			$this->kd_penerima->HrefValue = "";
			$this->kd_penerima->TooltipValue = "";

			// kd_unit
			$this->kd_unit->LinkCustomAttributes = "";
			$this->kd_unit->HrefValue = "";
			$this->kd_unit->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// kd_penerimaan
			$this->kd_penerimaan->EditAttrs["class"] = "form-control";
			$this->kd_penerimaan->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->kd_penerimaan->CurrentValue = HtmlDecode($this->kd_penerimaan->CurrentValue);
			$this->kd_penerimaan->EditValue = HtmlEncode($this->kd_penerimaan->CurrentValue);
			$this->kd_penerimaan->PlaceHolder = RemoveHtml($this->kd_penerimaan->caption());

			// tgl_penerimaan
			$this->tgl_penerimaan->EditAttrs["class"] = "form-control";
			$this->tgl_penerimaan->EditCustomAttributes = "";
			$this->tgl_penerimaan->EditValue = HtmlEncode(FormatDateTime($this->tgl_penerimaan->CurrentValue, 5));
			$this->tgl_penerimaan->PlaceHolder = RemoveHtml($this->tgl_penerimaan->caption());

			// kd_penerima
			$this->kd_penerima->EditAttrs["class"] = "form-control";
			$this->kd_penerima->EditCustomAttributes = "";
			$this->kd_penerima->EditValue = HtmlEncode($this->kd_penerima->CurrentValue);
			$curVal = strval($this->kd_penerima->CurrentValue);
			if ($curVal <> "") {
				$this->kd_penerima->EditValue = $this->kd_penerima->lookupCacheOption($curVal);
				if ($this->kd_penerima->EditValue === NULL) { // Lookup from database
					$filterWrk = "`kd_penerima`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kd_penerima->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->kd_penerima->EditValue = $this->kd_penerima->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kd_penerima->EditValue = HtmlEncode($this->kd_penerima->CurrentValue);
					}
				}
			} else {
				$this->kd_penerima->EditValue = NULL;
			}
			$this->kd_penerima->PlaceHolder = RemoveHtml($this->kd_penerima->caption());

			// kd_unit
			$this->kd_unit->EditAttrs["class"] = "form-control";
			$this->kd_unit->EditCustomAttributes = "";
			$curVal = trim(strval($this->kd_unit->CurrentValue));
			if ($curVal <> "")
				$this->kd_unit->ViewValue = $this->kd_unit->lookupCacheOption($curVal);
			else
				$this->kd_unit->ViewValue = $this->kd_unit->Lookup !== NULL && is_array($this->kd_unit->Lookup->Options) ? $curVal : NULL;
			if ($this->kd_unit->ViewValue !== NULL) { // Load from cache
				$this->kd_unit->EditValue = array_values($this->kd_unit->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kd_unit`" . SearchString("=", $this->kd_unit->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kd_unit->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->kd_unit->EditValue = $arwrk;
			}

			// Add refer script
			// kd_penerimaan

			$this->kd_penerimaan->LinkCustomAttributes = "";
			$this->kd_penerimaan->HrefValue = "";

			// tgl_penerimaan
			$this->tgl_penerimaan->LinkCustomAttributes = "";
			$this->tgl_penerimaan->HrefValue = "";

			// kd_penerima
			$this->kd_penerima->LinkCustomAttributes = "";
			$this->kd_penerima->HrefValue = "";

			// kd_unit
			$this->kd_unit->LinkCustomAttributes = "";
			$this->kd_unit->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->kd_penerimaan->Required) {
			if (!$this->kd_penerimaan->IsDetailKey && $this->kd_penerimaan->FormValue != NULL && $this->kd_penerimaan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kd_penerimaan->caption(), $this->kd_penerimaan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->kd_penerimaan->FormValue)) {
			AddMessage($FormError, $this->kd_penerimaan->errorMessage());
		}
		if ($this->tgl_penerimaan->Required) {
			if (!$this->tgl_penerimaan->IsDetailKey && $this->tgl_penerimaan->FormValue != NULL && $this->tgl_penerimaan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_penerimaan->caption(), $this->tgl_penerimaan->RequiredErrorMessage));
			}
		}
		if (!CheckStdDate($this->tgl_penerimaan->FormValue)) {
			AddMessage($FormError, $this->tgl_penerimaan->errorMessage());
		}
		if ($this->kd_penerima->Required) {
			if (!$this->kd_penerima->IsDetailKey && $this->kd_penerima->FormValue != NULL && $this->kd_penerima->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kd_penerima->caption(), $this->kd_penerima->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->kd_penerima->FormValue)) {
			AddMessage($FormError, $this->kd_penerima->errorMessage());
		}
		if ($this->kd_unit->Required) {
			if (!$this->kd_unit->IsDetailKey && $this->kd_unit->FormValue != NULL && $this->kd_unit->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kd_unit->caption(), $this->kd_unit->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("trx_penerimaan_detail", $detailTblVar) && $GLOBALS["trx_penerimaan_detail"]->DetailAdd) {
			if (!isset($GLOBALS["trx_penerimaan_detail_grid"]))
				$GLOBALS["trx_penerimaan_detail_grid"] = new trx_penerimaan_detail_grid(); // Get detail page object
			$GLOBALS["trx_penerimaan_detail_grid"]->validateGridForm();
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = &$this->getConnection();

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// kd_penerimaan
		$this->kd_penerimaan->setDbValueDef($rsnew, $this->kd_penerimaan->CurrentValue, "", FALSE);

		// tgl_penerimaan
		$this->tgl_penerimaan->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_penerimaan->CurrentValue, 5), NULL, FALSE);

		// kd_penerima
		$this->kd_penerima->setDbValueDef($rsnew, $this->kd_penerima->CurrentValue, NULL, FALSE);

		// kd_unit
		$this->kd_unit->setDbValueDef($rsnew, $this->kd_unit->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['kd_penerimaan']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check for duplicate key
		if ($insertRow && $this->ValidateKey) {
			$filter = $this->getRecordFilter();
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
				$this->setFailureMessage($keyErrMsg);
				$rsChk->close();
				$insertRow = FALSE;
			}
		}
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("trx_penerimaan_detail", $detailTblVar) && $GLOBALS["trx_penerimaan_detail"]->DetailAdd) {
				$GLOBALS["trx_penerimaan_detail"]->kd_penerimaan->setSessionValue($this->kd_penerimaan->CurrentValue); // Set master key
				if (!isset($GLOBALS["trx_penerimaan_detail_grid"]))
					$GLOBALS["trx_penerimaan_detail_grid"] = new trx_penerimaan_detail_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "trx_penerimaan_detail"); // Load user level of detail table
				$addRow = $GLOBALS["trx_penerimaan_detail_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow)
					$GLOBALS["trx_penerimaan_detail"]->kd_penerimaan->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		if (Get(TABLE_SHOW_DETAIL) !== NULL) {
			$detailTblVar = Get(TABLE_SHOW_DETAIL);
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar <> "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("trx_penerimaan_detail", $detailTblVar)) {
				if (!isset($GLOBALS["trx_penerimaan_detail_grid"]))
					$GLOBALS["trx_penerimaan_detail_grid"] = new trx_penerimaan_detail_grid();
				if ($GLOBALS["trx_penerimaan_detail_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["trx_penerimaan_detail_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["trx_penerimaan_detail_grid"]->CurrentMode = "add";
					$GLOBALS["trx_penerimaan_detail_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["trx_penerimaan_detail_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["trx_penerimaan_detail_grid"]->setStartRecordNumber(1);
					$GLOBALS["trx_penerimaan_detail_grid"]->kd_penerimaan->IsDetailKey = TRUE;
					$GLOBALS["trx_penerimaan_detail_grid"]->kd_penerimaan->CurrentValue = $this->kd_penerimaan->CurrentValue;
					$GLOBALS["trx_penerimaan_detail_grid"]->kd_penerimaan->setSessionValue($GLOBALS["trx_penerimaan_detail_grid"]->kd_penerimaan->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("trx_penerimaanlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_kd_penerima":
							break;
						case "x_kd_unit":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>