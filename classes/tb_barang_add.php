<?php
namespace PHPMaker2019\project4;

/**
 * Page class
 */
class tb_barang_add extends tb_barang
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}";

	// Table name
	public $TableName = 'tb_barang';

	// Page object name
	public $PageObjName = "tb_barang_add";

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

		// Table object (tb_barang)
		if (!isset($GLOBALS["tb_barang"]) || get_class($GLOBALS["tb_barang"]) == PROJECT_NAMESPACE . "tb_barang") {
			$GLOBALS["tb_barang"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tb_barang"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tb_barang');

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
		global $EXPORT, $tb_barang;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tb_barang);
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
					if ($pageName == "tb_barangview.php")
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
			$key .= @$ar['kode_barang'];
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
					$this->terminate(GetUrl("tb_baranglist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->kode_barang->setVisibility();
		$this->nama_barang->setVisibility();
		$this->kd_kategori->setVisibility();
		$this->kd_satuan->setVisibility();
		$this->stok_awal->setVisibility();
		$this->stok_akhir->setVisibility();
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
		$this->setupLookupOptions($this->kd_kategori);
		$this->setupLookupOptions($this->kd_satuan);

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
			if (Get("kode_barang") !== NULL) {
				$this->kode_barang->setQueryStringValue(Get("kode_barang"));
				$this->setKey("kode_barang", $this->kode_barang->CurrentValue); // Set up key
			} else {
				$this->setKey("kode_barang", ""); // Clear key
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
					$this->terminate("tb_baranglist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "tb_baranglist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tb_barangview.php")
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
		$this->kode_barang->CurrentValue = NULL;
		$this->kode_barang->OldValue = $this->kode_barang->CurrentValue;
		$this->nama_barang->CurrentValue = NULL;
		$this->nama_barang->OldValue = $this->nama_barang->CurrentValue;
		$this->kd_kategori->CurrentValue = NULL;
		$this->kd_kategori->OldValue = $this->kd_kategori->CurrentValue;
		$this->kd_satuan->CurrentValue = NULL;
		$this->kd_satuan->OldValue = $this->kd_satuan->CurrentValue;
		$this->stok_awal->CurrentValue = NULL;
		$this->stok_awal->OldValue = $this->stok_awal->CurrentValue;
		$this->stok_akhir->CurrentValue = NULL;
		$this->stok_akhir->OldValue = $this->stok_akhir->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'kode_barang' first before field var 'x_kode_barang'
		$val = $CurrentForm->hasValue("kode_barang") ? $CurrentForm->getValue("kode_barang") : $CurrentForm->getValue("x_kode_barang");
		if (!$this->kode_barang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kode_barang->Visible = FALSE; // Disable update for API request
			else
				$this->kode_barang->setFormValue($val);
		}

		// Check field name 'nama_barang' first before field var 'x_nama_barang'
		$val = $CurrentForm->hasValue("nama_barang") ? $CurrentForm->getValue("nama_barang") : $CurrentForm->getValue("x_nama_barang");
		if (!$this->nama_barang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama_barang->Visible = FALSE; // Disable update for API request
			else
				$this->nama_barang->setFormValue($val);
		}

		// Check field name 'kd_kategori' first before field var 'x_kd_kategori'
		$val = $CurrentForm->hasValue("kd_kategori") ? $CurrentForm->getValue("kd_kategori") : $CurrentForm->getValue("x_kd_kategori");
		if (!$this->kd_kategori->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kd_kategori->Visible = FALSE; // Disable update for API request
			else
				$this->kd_kategori->setFormValue($val);
		}

		// Check field name 'kd_satuan' first before field var 'x_kd_satuan'
		$val = $CurrentForm->hasValue("kd_satuan") ? $CurrentForm->getValue("kd_satuan") : $CurrentForm->getValue("x_kd_satuan");
		if (!$this->kd_satuan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kd_satuan->Visible = FALSE; // Disable update for API request
			else
				$this->kd_satuan->setFormValue($val);
		}

		// Check field name 'stok_awal' first before field var 'x_stok_awal'
		$val = $CurrentForm->hasValue("stok_awal") ? $CurrentForm->getValue("stok_awal") : $CurrentForm->getValue("x_stok_awal");
		if (!$this->stok_awal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->stok_awal->Visible = FALSE; // Disable update for API request
			else
				$this->stok_awal->setFormValue($val);
		}

		// Check field name 'stok_akhir' first before field var 'x_stok_akhir'
		$val = $CurrentForm->hasValue("stok_akhir") ? $CurrentForm->getValue("stok_akhir") : $CurrentForm->getValue("x_stok_akhir");
		if (!$this->stok_akhir->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->stok_akhir->Visible = FALSE; // Disable update for API request
			else
				$this->stok_akhir->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->kode_barang->CurrentValue = $this->kode_barang->FormValue;
		$this->nama_barang->CurrentValue = $this->nama_barang->FormValue;
		$this->kd_kategori->CurrentValue = $this->kd_kategori->FormValue;
		$this->kd_satuan->CurrentValue = $this->kd_satuan->FormValue;
		$this->stok_awal->CurrentValue = $this->stok_awal->FormValue;
		$this->stok_akhir->CurrentValue = $this->stok_akhir->FormValue;
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
		$this->kode_barang->setDbValue($row['kode_barang']);
		$this->nama_barang->setDbValue($row['nama_barang']);
		$this->kd_kategori->setDbValue($row['kd_kategori']);
		$this->kd_satuan->setDbValue($row['kd_satuan']);
		$this->stok_awal->setDbValue($row['stok_awal']);
		$this->stok_akhir->setDbValue($row['stok_akhir']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['kode_barang'] = $this->kode_barang->CurrentValue;
		$row['nama_barang'] = $this->nama_barang->CurrentValue;
		$row['kd_kategori'] = $this->kd_kategori->CurrentValue;
		$row['kd_satuan'] = $this->kd_satuan->CurrentValue;
		$row['stok_awal'] = $this->stok_awal->CurrentValue;
		$row['stok_akhir'] = $this->stok_akhir->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("kode_barang")) <> "")
			$this->kode_barang->CurrentValue = $this->getKey("kode_barang"); // kode_barang
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
		// kode_barang
		// nama_barang
		// kd_kategori
		// kd_satuan
		// stok_awal
		// stok_akhir

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// kode_barang
			$this->kode_barang->ViewValue = $this->kode_barang->CurrentValue;
			$this->kode_barang->ViewCustomAttributes = "";

			// nama_barang
			$this->nama_barang->ViewValue = $this->nama_barang->CurrentValue;
			$this->nama_barang->ViewCustomAttributes = "";

			// kd_kategori
			$curVal = strval($this->kd_kategori->CurrentValue);
			if ($curVal <> "") {
				$this->kd_kategori->ViewValue = $this->kd_kategori->lookupCacheOption($curVal);
				if ($this->kd_kategori->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kd_kategori`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kd_kategori->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->kd_kategori->ViewValue = $this->kd_kategori->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kd_kategori->ViewValue = $this->kd_kategori->CurrentValue;
					}
				}
			} else {
				$this->kd_kategori->ViewValue = NULL;
			}
			$this->kd_kategori->ViewCustomAttributes = "";

			// kd_satuan
			$curVal = strval($this->kd_satuan->CurrentValue);
			if ($curVal <> "") {
				$this->kd_satuan->ViewValue = $this->kd_satuan->lookupCacheOption($curVal);
				if ($this->kd_satuan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kd_satuan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kd_satuan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->kd_satuan->ViewValue = $this->kd_satuan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kd_satuan->ViewValue = $this->kd_satuan->CurrentValue;
					}
				}
			} else {
				$this->kd_satuan->ViewValue = NULL;
			}
			$this->kd_satuan->ViewCustomAttributes = "";

			// stok_awal
			$this->stok_awal->ViewValue = $this->stok_awal->CurrentValue;
			$this->stok_awal->ViewValue = FormatNumber($this->stok_awal->ViewValue, 0, -2, -2, -2);
			$this->stok_awal->ViewCustomAttributes = "";

			// stok_akhir
			$this->stok_akhir->ViewValue = $this->stok_akhir->CurrentValue;
			$this->stok_akhir->ViewValue = FormatNumber($this->stok_akhir->ViewValue, 0, -2, -2, -2);
			$this->stok_akhir->ViewCustomAttributes = "";

			// kode_barang
			$this->kode_barang->LinkCustomAttributes = "";
			$this->kode_barang->HrefValue = "";
			$this->kode_barang->TooltipValue = "";

			// nama_barang
			$this->nama_barang->LinkCustomAttributes = "";
			$this->nama_barang->HrefValue = "";
			$this->nama_barang->TooltipValue = "";

			// kd_kategori
			$this->kd_kategori->LinkCustomAttributes = "";
			$this->kd_kategori->HrefValue = "";
			$this->kd_kategori->TooltipValue = "";

			// kd_satuan
			$this->kd_satuan->LinkCustomAttributes = "";
			$this->kd_satuan->HrefValue = "";
			$this->kd_satuan->TooltipValue = "";

			// stok_awal
			$this->stok_awal->LinkCustomAttributes = "";
			$this->stok_awal->HrefValue = "";
			$this->stok_awal->TooltipValue = "";

			// stok_akhir
			$this->stok_akhir->LinkCustomAttributes = "";
			$this->stok_akhir->HrefValue = "";
			$this->stok_akhir->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// kode_barang
			$this->kode_barang->EditAttrs["class"] = "form-control";
			$this->kode_barang->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->kode_barang->CurrentValue = HtmlDecode($this->kode_barang->CurrentValue);
			$this->kode_barang->EditValue = HtmlEncode($this->kode_barang->CurrentValue);
			$this->kode_barang->PlaceHolder = RemoveHtml($this->kode_barang->caption());

			// nama_barang
			$this->nama_barang->EditAttrs["class"] = "form-control";
			$this->nama_barang->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->nama_barang->CurrentValue = HtmlDecode($this->nama_barang->CurrentValue);
			$this->nama_barang->EditValue = HtmlEncode($this->nama_barang->CurrentValue);
			$this->nama_barang->PlaceHolder = RemoveHtml($this->nama_barang->caption());

			// kd_kategori
			$this->kd_kategori->EditAttrs["class"] = "form-control";
			$this->kd_kategori->EditCustomAttributes = "";
			$curVal = trim(strval($this->kd_kategori->CurrentValue));
			if ($curVal <> "")
				$this->kd_kategori->ViewValue = $this->kd_kategori->lookupCacheOption($curVal);
			else
				$this->kd_kategori->ViewValue = $this->kd_kategori->Lookup !== NULL && is_array($this->kd_kategori->Lookup->Options) ? $curVal : NULL;
			if ($this->kd_kategori->ViewValue !== NULL) { // Load from cache
				$this->kd_kategori->EditValue = array_values($this->kd_kategori->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kd_kategori`" . SearchString("=", $this->kd_kategori->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kd_kategori->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->kd_kategori->EditValue = $arwrk;
			}

			// kd_satuan
			$this->kd_satuan->EditAttrs["class"] = "form-control";
			$this->kd_satuan->EditCustomAttributes = "";
			$curVal = trim(strval($this->kd_satuan->CurrentValue));
			if ($curVal <> "")
				$this->kd_satuan->ViewValue = $this->kd_satuan->lookupCacheOption($curVal);
			else
				$this->kd_satuan->ViewValue = $this->kd_satuan->Lookup !== NULL && is_array($this->kd_satuan->Lookup->Options) ? $curVal : NULL;
			if ($this->kd_satuan->ViewValue !== NULL) { // Load from cache
				$this->kd_satuan->EditValue = array_values($this->kd_satuan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kd_satuan`" . SearchString("=", $this->kd_satuan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kd_satuan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->kd_satuan->EditValue = $arwrk;
			}

			// stok_awal
			$this->stok_awal->EditAttrs["class"] = "form-control";
			$this->stok_awal->EditCustomAttributes = "";
			$this->stok_awal->EditValue = HtmlEncode($this->stok_awal->CurrentValue);
			$this->stok_awal->PlaceHolder = RemoveHtml($this->stok_awal->caption());

			// stok_akhir
			$this->stok_akhir->EditAttrs["class"] = "form-control";
			$this->stok_akhir->EditCustomAttributes = "";
			$this->stok_akhir->EditValue = HtmlEncode($this->stok_akhir->CurrentValue);
			$this->stok_akhir->PlaceHolder = RemoveHtml($this->stok_akhir->caption());

			// Add refer script
			// kode_barang

			$this->kode_barang->LinkCustomAttributes = "";
			$this->kode_barang->HrefValue = "";

			// nama_barang
			$this->nama_barang->LinkCustomAttributes = "";
			$this->nama_barang->HrefValue = "";

			// kd_kategori
			$this->kd_kategori->LinkCustomAttributes = "";
			$this->kd_kategori->HrefValue = "";

			// kd_satuan
			$this->kd_satuan->LinkCustomAttributes = "";
			$this->kd_satuan->HrefValue = "";

			// stok_awal
			$this->stok_awal->LinkCustomAttributes = "";
			$this->stok_awal->HrefValue = "";

			// stok_akhir
			$this->stok_akhir->LinkCustomAttributes = "";
			$this->stok_akhir->HrefValue = "";
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
		if ($this->kode_barang->Required) {
			if (!$this->kode_barang->IsDetailKey && $this->kode_barang->FormValue != NULL && $this->kode_barang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kode_barang->caption(), $this->kode_barang->RequiredErrorMessage));
			}
		}
		if ($this->nama_barang->Required) {
			if (!$this->nama_barang->IsDetailKey && $this->nama_barang->FormValue != NULL && $this->nama_barang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama_barang->caption(), $this->nama_barang->RequiredErrorMessage));
			}
		}
		if ($this->kd_kategori->Required) {
			if (!$this->kd_kategori->IsDetailKey && $this->kd_kategori->FormValue != NULL && $this->kd_kategori->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kd_kategori->caption(), $this->kd_kategori->RequiredErrorMessage));
			}
		}
		if ($this->kd_satuan->Required) {
			if (!$this->kd_satuan->IsDetailKey && $this->kd_satuan->FormValue != NULL && $this->kd_satuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kd_satuan->caption(), $this->kd_satuan->RequiredErrorMessage));
			}
		}
		if ($this->stok_awal->Required) {
			if (!$this->stok_awal->IsDetailKey && $this->stok_awal->FormValue != NULL && $this->stok_awal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->stok_awal->caption(), $this->stok_awal->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->stok_awal->FormValue)) {
			AddMessage($FormError, $this->stok_awal->errorMessage());
		}
		if ($this->stok_akhir->Required) {
			if (!$this->stok_akhir->IsDetailKey && $this->stok_akhir->FormValue != NULL && $this->stok_akhir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->stok_akhir->caption(), $this->stok_akhir->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->stok_akhir->FormValue)) {
			AddMessage($FormError, $this->stok_akhir->errorMessage());
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

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// kode_barang
		$this->kode_barang->setDbValueDef($rsnew, $this->kode_barang->CurrentValue, "", FALSE);

		// nama_barang
		$this->nama_barang->setDbValueDef($rsnew, $this->nama_barang->CurrentValue, NULL, FALSE);

		// kd_kategori
		$this->kd_kategori->setDbValueDef($rsnew, $this->kd_kategori->CurrentValue, NULL, FALSE);

		// kd_satuan
		$this->kd_satuan->setDbValueDef($rsnew, $this->kd_satuan->CurrentValue, NULL, FALSE);

		// stok_awal
		$this->stok_awal->setDbValueDef($rsnew, $this->stok_awal->CurrentValue, 0, FALSE);

		// stok_akhir
		$this->stok_akhir->setDbValueDef($rsnew, $this->stok_akhir->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['kode_barang']) == "") {
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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tb_baranglist.php"), "", $this->TableVar, TRUE);
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
						case "x_kd_kategori":
							break;
						case "x_kd_satuan":
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