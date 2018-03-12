<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Routing\Controller;
use DB;

class MainController extends Controller {

	public function index() {


		return view('index');
	}

	/*protected function getAlphabet() {
		$alphabet = array_merge(['#'], array_combine(range('a', 'z'), range('A', 'Z')));
		foreach($alphabet as $letter => $title) {
			$query = $letter
				? Dll::where('alias', 'like', $letter . '%')
				: Dll::where('alias', 'REGEXP', '^[^a-z]');
			if(!$query->exists()) {
				unset($alphabet[$letter]);
			}
		}
		return $alphabet;
	}

	public function dllByLetter($letter) {

		$dllsbyletter = $letter
			? DLL::where('name', 'LIKE', $letter . '%')->groupBy('alias')->orderBy('alias')->get()
			: DLL::where('name', 'REGEXP', '^[^a-z]')->groupBy('alias')->orderBy('alias')->get();

		$letter = $letter ?: '#';

		return view('dllbyletter', [
			'_title' => 'Wiki Dll',
			'_description' => 'Wiki Dll',
			'_keywords' => 'Wiki Dll',
			'dllsbyletter' => $dllsbyletter,
			'dllletter' => strtoupper($letter),
			'_breadcrumbs' => $this->getBreadcrumbs([
				'Dll-files starting with ' . strtoupper($letter) => '',

			]),
		]);
	}

	public function company($company) {
		$dllsByCompany = DLL::where('company_url', $company)->groupBy('alias')->get();
		$companyObj = $dllsByCompany->first();

		if(!count($dllsByCompany)) {
			abort(404);
		}
		$allCompanies = DLL::orderBy('company')->groupBy('company_alias')->get();

		return view('company', [
			'_title' => 'Wiki Dll',
			'_description' => 'Wiki Dll',
			'_keywords' => 'Wiki Dll',
			'dllsByCompany' => $dllsByCompany,
			'allCompanies' => $allCompanies,
			'companyName' => $companyObj->company_alias,
			'_breadcrumbs' => $this->getBreadcrumbs([
				$companyObj->company_alias . ' Dll Files ' => '',

			]),
		]);
	}

	public function download($id) {
		$dll = Dll::findOrFail($id);
		return view('download', [
			'_title' => 'Download',
			'_description' => 'Wiki Dll',
			'_keywords' => 'Wiki Dll',
			'dll' => $dll,
			'_breadcrumbs' => $this->getBreadcrumbs([
				$dll->name => '',
			]),
		]);
	}

	public function downloadFile($id, $name) {
		$headers = [
			'Content-Type' => 'application/zip',
		];

		return response()->download(Dll::findOrFail($id)->getFilePath(), $name, $headers);
	}

	public function dll($company, $dllAlias) {
		$dll = DLL::where('alias', $dllAlias)->first();
		$dllVersions = Dll::where('alias', $dllAlias)->orderBy('ver', 'desc')->get();
		$popularDlls = Dll::orderBy('downloads', 'desc')->whereNotNull('desc')->groupBy('alias')->limit(5)->get();
		$otherDlls = Dll::whereNotNull('desc')->whereIn('id', [mt_rand(1, 25000), mt_rand(1, 25000), mt_rand(1, 25000), mt_rand(1, 25000), mt_rand(1, 25000)])->get();

		if(!count($dll)) {
			abort(404);
		}

		return view('dll', [
			'_title' => 'Wiki Dll',
			'_description' => 'Wiki Dll',
			'_keywords' => 'Wiki Dll',
			'dll' => $dll,
			'dllVersions' => $dllVersions,
			'companyName' => $dll->company_alias,
			'popularDlls' => $popularDlls,
			'otherDlls' => $otherDlls,
			'_breadcrumbs' => $this->getBreadcrumbs([
				$dll->company_alias => route('company', $dll->company_url),
				$dll->name . ' download' => '',

			]),
		]);
	}

	public function search() {

		$name = request('name');
		$result = Dll::where('alias', 'like', trim(preg_replace(['/[^a-z\d]+/i'], ['%'], $name), '%') . '%')->orderBy('alias')->groupBy('alias')->get();

		return view('search_result', [
			'_title' => 'Wiki Dll',
			'_description' => 'Wiki Dll',
			'_keywords' => 'Wiki Dll',
			'result' => $result,
			'query' => request('name'),
			'_breadcrumbs' => $this->getBreadcrumbs([
				'Search Result for" ' . request('name') . '"' => '',

			]),
		]);
	}

	public function about() {
		$h1 = "Company";
		return view('info.about', [
			'_title' => trim($h1, '.') . " - Wiki Dll",
			'_description' => trim($h1, '.'),
			'h1' => $h1,
			'_breadcrumbs' => $this->getBreadcrumbs([
				$h1 => '',
			]),
		]);
	}

	public function partners() {
		$h1 = "Partners";
		return view('info.partners', [
			'_title' => trim($h1, '.') . " - Wiki Dll",
			'_description' => trim($h1, '.'),
			'h1' => $h1,
			'_breadcrumbs' => $this->getBreadcrumbs([
				$h1 => '',
			]),
		]);
	}

	public function privacy() {
		$h1 = "Privacy Policy";
		return view('info.policy', [
			'_title' => trim($h1, '.') . " - Wiki Dll",
			'_description' => trim($h1, '.'),
			'h1' => $h1,
			'_breadcrumbs' => $this->getBreadcrumbs([
				$h1 => '',
			]),
		]);
	}

	public function legal_notice() {
		$h1 = "Legal Notice";
		return view('info.legal_notice', [
			'_title' => trim($h1, '.') . " - Wiki Dll",
			'_description' => trim($h1, '.'),
			'h1' => $h1,
			'_breadcrumbs' => $this->getBreadcrumbs([
				$h1 => '',
			]),
		]);
	}

	protected function getBreadcrumbs(array $urlsTitles = []) {
		return array_merge([
			'Home' => route('index'),
		], $urlsTitles);
	}
*/
}
